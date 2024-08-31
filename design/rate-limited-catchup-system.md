# Rate-Limited Catch-Up System for Event Persistence

## Overview

We'll implement a rate limiting mechanism for catch-up requests in our Event Persistence System. This will prevent clients from overwhelming the server with too many requests and protect against potential abuse.

## Key Components

1. **RateLimiter**: A class to manage and enforce rate limits.
2. **PersistentWebSocketManager**: Will be updated to use the RateLimiter for catch-up requests.
3. **ClientSession**: Will be extended to track rate limit data.

## Implementation

### 1. RateLimiter Class

First, let's create a RateLimiter class that will manage rate limits:

File: `src/Utils/RateLimiter.php`

```php
<?php

namespace YourFramework\Utils;

use Redis;

class RateLimiter
{
    private Redis $redis;
    private int $maxRequests;
    private int $perSeconds;

    public function __construct(Redis $redis, int $maxRequests, int $perSeconds)
    {
        $this->redis = $redis;
        $this->maxRequests = $maxRequests;
        $this->perSeconds = $perSeconds;
    }

    public function attempt(string $key): bool
    {
        $current = $this->redis->get($key);

        if ($current === false) {
            $this->redis->setex($key, $this->perSeconds, 1);
            return true;
        }

        if ($current < $this->maxRequests) {
            $this->redis->incr($key);
            return true;
        }

        return false;
    }

    public function getRemainingAttempts(string $key): int
    {
        $current = $this->redis->get($key);
        if ($current === false) {
            return $this->maxRequests;
        }
        return max(0, $this->maxRequests - $current);
    }
}
```

### 2. Update ClientSession

Let's update the ClientSession class to include rate limit information:

File: `src/WebSockets/ClientSession.php`

```php
<?php

namespace YourFramework\WebSockets;

use Ratchet\ConnectionInterface;

class ClientSession
{
    private ConnectionInterface $connection;
    private int $lastEventId = 0;
    private int $lastCatchUpRequest = 0;

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

    public function updateLastCatchUpRequest(): void
    {
        $this->lastCatchUpRequest = time();
    }

    public function getLastCatchUpRequest(): int
    {
        return $this->lastCatchUpRequest;
    }
}
```

### 3. Update PersistentWebSocketManager

Now, let's modify the PersistentWebSocketManager to incorporate rate limiting:

File: `src/WebSockets/PersistentWebSocketManager.php`

```php
<?php

namespace YourFramework\WebSockets;

use Ratchet\ConnectionInterface;
use YourFramework\Events\EventStore;
use YourFramework\Utils\RateLimiter;

class PersistentWebSocketManager extends WebSocketManager
{
    private EventStore $eventStore;
    private array $clientSessions = [];
    private int $currentEventId = 0;
    private RateLimiter $rateLimiter;

    public function __construct(EventStore $eventStore, RateLimiter $rateLimiter)
    {
        parent::__construct();
        $this->eventStore = $eventStore;
        $this->rateLimiter = $rateLimiter;
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
        $session = $this->clientSessions[$conn->resourceId];
        $rateLimitKey = "catch_up_rate_limit:{$conn->resourceId}";

        if (!$this->rateLimiter->attempt($rateLimitKey)) {
            $remainingAttempts = $this->rateLimiter->getRemainingAttempts($rateLimitKey);
            $conn->send(json_encode([
                'error' => 'Rate limit exceeded',
                'remainingAttempts' => $remainingAttempts
            ]));
            return;
        }

        $session->updateLastCatchUpRequest();

        $missedEvents = $this->eventStore->getEventsSince($lastEventId);
        foreach ($missedEvents as $event) {
            $conn->send(json_encode($event));
        }
        $session->setLastEventId(end($missedEvents)['id'] ?? $lastEventId);
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

### 4. Update Application Setup

Modify your application setup to include the RateLimiter:

```php
<?php

$redis = new Redis();
$redis->connect('localhost', 6379);

$eventStore = new EventStore($redis);
$rateLimiter = new RateLimiter($redis, 5, 60); // 5 requests per 60 seconds
$webSocketManager = new PersistentWebSocketManager($eventStore, $rateLimiter);
$broadcaster = new WebSocketEventBroadcaster($webSocketManager);

// Use $broadcaster in your EventDispatcher
```

### 5. Update Client-side Code

Update the client-side JavaScript to handle rate limit errors:

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
            if (data.error === 'Rate limit exceeded') {
                console.warn(`Catch-up rate limit exceeded. Remaining attempts: ${data.remainingAttempts}`);
                // Implement backoff strategy here
                setTimeout(() => this.catchUp(), 5000); // Wait 5 seconds before retrying
            } else {
                this.handleEvent(data);
                this.lastEventId = data.id;
            }
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

## Best Practices

1. Choose appropriate rate limit values based on your application's needs and server capacity.
2. Implement a backoff strategy on the client-side to handle rate limit errors gracefully.
3. Consider implementing different rate limits for different types of clients or users.
4. Monitor rate limit hits to identify potential abuse or need for limit adjustments.
5. Provide clear feedback to clients when they hit rate limits, including when they can try again.

## Next Steps

1. Implement adaptive rate limiting based on server load or time of day.
2. Create a system to whitelist certain trusted clients that may need higher rate limits.
3. Implement more sophisticated backoff strategies on the client-side.
4. Add detailed logging of rate limit hits for security monitoring.
5. Create an admin interface to adjust rate limits in real-time without requiring a server restart.

This rate-limited catch-up system provides protection against potential abuse while still allowing legitimate clients to recover missed events. It enhances the robustness and reliability of your event persistence system.
