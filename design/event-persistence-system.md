# Event Persistence System for Real-time Event Streaming

## Overview

We'll implement an event persistence system that temporarily stores broadcasted events. When clients reconnect, they can request and receive any events they missed during their disconnection period.

## Key Components

1. **EventStore**: Responsible for storing and retrieving recent events.
2. **PersistentWebSocketManager**: Extends WebSocketManager to handle event persistence and client catch-up.
3. **ClientSession**: Tracks client connection state and last received event.
4. **CatchUpProtocol**: Defines the protocol for clients to request missed events.

## Implementation

### 1. EventStore

First, let's create an EventStore class to manage event persistence:

File: `src/Events/EventStore.php`

```php
<?php

namespace YourFramework\Events;

use Redis;

class EventStore
{
    private Redis $redis;
    private string $eventListKey = 'recent_events';
    private int $maxEvents;

    public function __construct(Redis $redis, int $maxEvents = 1000)
    {
        $this->redis = $redis;
        $this->maxEvents = $maxEvents;
    }

    public function storeEvent(string $eventJson): void
    {
        $this->redis->multi();
        $this->redis->lPush($this->eventListKey, $eventJson);
        $this->redis->lTrim($this->eventListKey, 0, $this->maxEvents - 1);
        $this->redis->exec();
    }

    public function getEventsSince(int $lastEventId): array
    {
        $events = $this->redis->lRange($this->eventListKey, 0, -1);
        $missedEvents = [];
        foreach ($events as $event) {
            $eventData = json_decode($event, true);
            if ($eventData['id'] > $lastEventId) {
                $missedEvents[] = $eventData;
            } else {
                break;
            }
        }
        return array_reverse($missedEvents);
    }
}
```

### 2. ClientSession

Let's create a ClientSession class to track client state:

File: `src/WebSockets/ClientSession.php`

```php
<?php

namespace YourFramework\WebSockets;

use Ratchet\ConnectionInterface;

class ClientSession
{
    private ConnectionInterface $connection;
    private int $lastEventId = 0;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }

    public function setLastEventId(int $eventId): void
    {
        $this->lastEventId = $eventId;
    }

    public function getLastEventId(): int
    {
        return $this->lastEventId;
    }
}
```

### 3. PersistentWebSocketManager

Now, let's create a PersistentWebSocketManager that extends our existing WebSocketManager:

File: `src/WebSockets/PersistentWebSocketManager.php`

```php
<?php

namespace YourFramework\WebSockets;

use Ratchet\ConnectionInterface;
use YourFramework\Events\EventStore;

class PersistentWebSocketManager extends WebSocketManager
{
    private EventStore $eventStore;
    private array $clientSessions = [];
    private int $currentEventId = 0;

    public function __construct(EventStore $eventStore)
    {
        parent::__construct();
        $this->eventStore = $eventStore;
    }

    public function onOpen(ConnectionInterface $conn): void
    {
        parent::onOpen($conn);
        $this->clientSessions[$conn->resourceId] = new ClientSession($conn);
    }

    public function onClose(ConnectionInterface $conn): void
    {
        parent::onClose($conn);
        unset($this->clientSessions[$conn->resourceId]);
    }

    public function onMessage(ConnectionInterface $from, $msg): void
    {
        $data = json_decode($msg, true);
        if (isset($data['action']) && $data['action'] === 'catch_up') {
            $this->handleCatchUpRequest($from, $data['lastEventId']);
        }
    }

    private function handleCatchUpRequest(ConnectionInterface $conn, int $lastEventId): void
    {
        $missedEvents = $this->eventStore->getEventsSince($lastEventId);
        foreach ($missedEvents as $event) {
            $conn->send(json_encode($event));
        }
        $this->clientSessions[$conn->resourceId]->setLastEventId(end($missedEvents)['id'] ?? $lastEventId);
    }

    public function broadcast(string $message): void
    {
        $eventData = json_decode($message, true);
        $eventData['id'] = ++$this->currentEventId;
        $eventJson = json_encode($eventData);

        $this->eventStore->storeEvent($eventJson);

        foreach ($this->clients as $client) {
            $client->send($eventJson);
            $this->clientSessions[$client->resourceId]->setLastEventId($this->currentEventId);
        }
    }
}
```

### 4. Update WebSocketEventBroadcaster

Modify the WebSocketEventBroadcaster to work with the new PersistentWebSocketManager:

File: `src/Events/WebSocketEventBroadcaster.php`

```php
<?php

namespace YourFramework\Events;

use YourFramework\WebSockets\PersistentWebSocketManager;

class WebSocketEventBroadcaster
{
    private PersistentWebSocketManager $webSocketManager;

    public function __construct(PersistentWebSocketManager $webSocketManager)
    {
        $this->webSocketManager = $webSocketManager;
    }

    public function broadcast(BroadcastableEvent $event): void
    {
        $eventData = [
            'event' => $event->broadcastAs(),
            'data' => $event->broadcastWith()
        ];

        $this->webSocketManager->broadcast(json_encode($eventData));
    }
}
```

### 5. Client-side Integration

Update the client-side JavaScript to handle reconnection and catch-up:

```javascript
class PersistentWebSocket {
    constructor(url) {
        this.url = url;
        this.lastEventId = 0;
        this.connect();
    }

    connect() {
        this.socket = new WebSocket(this.url);

        this.socket.onopen = () => {
            console.log('Connected to WebSocket');
            this.catchUp();
        };

        this.socket.onmessage = (event) => {
            const data = JSON.parse(event.data);
            this.handleEvent(data);
            this.lastEventId = data.id;
        };

        this.socket.onclose = () => {
            console.log('WebSocket connection closed. Reconnecting...');
            setTimeout(() => this.connect(), 1000);
        };
    }

    catchUp() {
        this.socket.send(JSON.stringify({
            action: 'catch_up',
            lastEventId: this.lastEventId
        }));
    }

    handleEvent(event) {
        // Handle different event types
        switch(event.event) {
            case 'user.registered':
                console.log('New user registered:', event.data);
                break;
            // Handle other event types
        }
    }
}

const persistentSocket = new PersistentWebSocket('ws://your-server-url');
```

## Usage

To use this persistent event system:

1. Initialize the EventStore with a Redis connection.
2. Create a PersistentWebSocketManager with the EventStore.
3. Use the PersistentWebSocketManager in your WebSocketEventBroadcaster.
4. On the client-side, use the PersistentWebSocket class to manage connections and catch-up.

Here's an example of setting it up in your application:

```php
<?php

$redis = new Redis();
$redis->connect('localhost', 6379);

$eventStore = new EventStore($redis);
$webSocketManager = new PersistentWebSocketManager($eventStore);
$broadcaster = new WebSocketEventBroadcaster($webSocketManager);

// Use $broadcaster in your EventDispatcher
```

## Best Practices

1. Choose an appropriate maximum number of stored events based on your application's needs and memory constraints.
2. Implement authentication for WebSocket connections to ensure that clients only receive events they're authorized to see.
3. Consider compressing event data if you're dealing with large volumes of events or limited bandwidth.
4. Implement monitoring and logging to track the number of stored events and catch-up requests.
5. Periodically clean up very old events to prevent unbounded growth of the event store.

## Next Steps

1. Implement event expiration to automatically remove old events from the store.
2. Add support for selective catch-up, allowing clients to specify which types of events they want to receive.
3. Implement a more sophisticated event storage system for long-term persistence if required.
4. Create a dashboard for monitoring real-time event flow and catch-up requests.
5. Implement rate limiting for catch-up requests to prevent abuse.

This event persistence system ensures that clients can recover from temporary disconnections without missing important events, greatly enhancing the reliability and user experience of your real-time applications.
