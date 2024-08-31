# Real-time Event Streaming with WebSockets

## Overview

We'll extend our event system to broadcast certain events to connected WebSocket clients in real-time. This will allow client-side applications to react immediately to server-side events.

## Key Components

1. **WebSocketEventBroadcaster**: Responsible for sending events to WebSocket clients.
2. **BroadcastableEvent**: An interface for events that can be broadcasted to clients.
3. **WebSocketManager**: (Existing component) Will be extended to handle event broadcasts.
4. **EventDispatcher**: (Existing component) Will be modified to use the WebSocketEventBroadcaster.

## Implementation

### 1. BroadcastableEvent Interface

First, let's define an interface for events that can be broadcasted:

File: `src/Events/BroadcastableEvent.php`

```php
<?php

namespace YourFramework\Events;

interface BroadcastableEvent
{
    public function broadcastAs(): string;
    public function broadcastWith(): array;
}
```

### 2. WebSocketEventBroadcaster

Now, let's create the WebSocketEventBroadcaster:

File: `src/Events/WebSocketEventBroadcaster.php`

```php
<?php

namespace YourFramework\Events;

use YourFramework\WebSockets\WebSocketManager;

class WebSocketEventBroadcaster
{
    private WebSocketManager $webSocketManager;

    public function __construct(WebSocketManager $webSocketManager)
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

### 3. Update EventDispatcher

Let's modify our EventDispatcher to use the WebSocketEventBroadcaster:

File: `src/Events/EventDispatcher.php`

```php
<?php

namespace YourFramework\Events;

class EventDispatcher
{
    private ListenerProvider $listenerProvider;
    private ?WebSocketEventBroadcaster $broadcaster;

    public function __construct(ListenerProvider $listenerProvider, ?WebSocketEventBroadcaster $broadcaster = null)
    {
        $this->listenerProvider = $listenerProvider;
        $this->broadcaster = $broadcaster;
    }

    public function dispatch(Event $event): Event
    {
        $eventName = get_class($event);

        foreach ($this->listenerProvider->getListenersForEvent($eventName) as $listener) {
            if ($event->isPropagationStopped()) {
                break;
            }

            $listener->handle($event);
        }

        if ($this->broadcaster && $event instanceof BroadcastableEvent) {
            $this->broadcaster->broadcast($event);
        }

        return $event;
    }

    // ... other methods remain the same
}
```

### 4. Update WebSocketManager

Extend the WebSocketManager to handle event broadcasts:

File: `src/WebSockets/WebSocketManager.php`

```php
<?php

namespace YourFramework\WebSockets;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketManager implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Handle incoming messages if needed
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }

    public function broadcast(string $message): void
    {
        foreach ($this->clients as $client) {
            $client->send($message);
        }
    }
}
```

### 5. Example Broadcastable Event

Here's an example of how to create a broadcastable event:

File: `src/Events/UserRegisteredEvent.php`

```php
<?php

namespace YourFramework\Events;

class UserRegisteredEvent extends Event implements BroadcastableEvent
{
    public function __construct(public readonly User $user)
    {
    }

    public function broadcastAs(): string
    {
        return 'user.registered';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'email' => $this->user->email
        ];
    }
}
```

### 6. Integration with Application

Update your Application class to use the WebSocketEventBroadcaster:

File: `src/Core/Application.php`

```php
<?php

namespace YourFramework\Core;

use YourFramework\Events\EventDispatcher;
use YourFramework\Events\WebSocketEventBroadcaster;
use YourFramework\WebSockets\WebSocketManager;

class Application
{
    // ... other properties

    private EventDispatcher $eventDispatcher;
    private WebSocketManager $webSocketManager;

    public function __construct(
        // ... other dependencies
        WebSocketManager $webSocketManager
    ) {
        // ... other initializations
        $this->webSocketManager = $webSocketManager;
        $broadcaster = new WebSocketEventBroadcaster($this->webSocketManager);
        $this->eventDispatcher = new EventDispatcher(new ListenerProvider(), $broadcaster);
    }

    // ... other methods
}
```

### 7. Client-side Integration

On the client-side, you'll need to establish a WebSocket connection and handle incoming events. Here's a basic example using JavaScript:

```javascript
const socket = new WebSocket('ws://your-server-url');

socket.onmessage = function(event) {
    const data = JSON.parse(event.data);
    switch(data.event) {
        case 'user.registered':
            console.log('New user registered:', data.data);
            // Update UI or perform other actions
            break;
        // Handle other event types
    }
};
```

## Usage Example

Here's how you might use this system:

```php
<?php

// In your controller or service
$user = new User('john@example.com', 'John Doe');
$event = new UserRegisteredEvent($user);
$app->dispatchEvent($event);
```

When this event is dispatched, it will be processed by any registered listeners and then automatically broadcast to all connected WebSocket clients.

## Best Practices

1. Only make events broadcastable if they truly need real-time client updates.
2. Be mindful of the data you're broadcasting - avoid sending sensitive information.
3. Implement authentication and authorization for WebSocket connections to ensure security.
4. Consider implementing a system to allow clients to subscribe only to specific event types.
5. Use a separate WebSocket server (like Ratchet or Swoole) for better performance and scalability.

## Next Steps

1. Implement channel-based broadcasting to allow fine-grained control over who receives which events.
2. Add support for private channels that require authentication.
3. Implement presence channels to track which users are currently online.
4. Create a client-side library to simplify WebSocket event handling.
5. Implement reconnection logic on the client-side to handle temporary disconnections.

This real-time event streaming system allows your framework to push events directly to connected clients, enabling the creation of highly responsive, real-time web applications.
