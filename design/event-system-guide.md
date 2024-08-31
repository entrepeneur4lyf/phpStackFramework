# Phase 6 Development Guide: Event System

## Overview

An event system allows different parts of an application to communicate without being directly coupled. It's essential for building flexible, scalable applications. We'll implement a robust event system that supports synchronous and asynchronous event handling, prioritization, and integration with our existing framework components.

## Key Components

1. **EventDispatcher**: Central hub for registering listeners and dispatching events.
2. **Event**: Base class for all events in the system.
3. **Listener**: Interface for event listeners.
4. **ListenerProvider**: Responsible for providing listeners for specific events.

## Implementation

### 1. Event Class

First, let's create a base Event class:

File: `src/Events/Event.php`

```php
<?php

namespace YourFramework\Events;

abstract class Event
{
    private bool $propagationStopped = false;

    public function isPropagationStopped(): bool
    {
        return $this->propagationStopped;
    }

    public function stopPropagation(): void
    {
        $this->propagationStopped = true;
    }
}
```

### 2. Listener Interface

Now, let's define the Listener interface:

File: `src/Events/ListenerInterface.php`

```php
<?php

namespace YourFramework\Events;

interface ListenerInterface
{
    public function handle(Event $event): void;
}
```

### 3. ListenerProvider

Let's create a ListenerProvider to manage listeners:

File: `src/Events/ListenerProvider.php`

```php
<?php

namespace YourFramework\Events;

class ListenerProvider
{
    private array $listeners = [];

    public function addListener(string $eventName, ListenerInterface $listener, int $priority = 0): void
    {
        $this->listeners[$eventName][$priority][] = $listener;
        ksort($this->listeners[$eventName]);
    }

    public function getListenersForEvent(string $eventName): iterable
    {
        $listeners = $this->listeners[$eventName] ?? [];
        foreach ($listeners as $priority => $priorityListeners) {
            foreach ($priorityListeners as $listener) {
                yield $listener;
            }
        }
    }
}
```

### 4. EventDispatcher

Now, let's implement the EventDispatcher:

File: `src/Events/EventDispatcher.php`

```php
<?php

namespace YourFramework\Events;

class EventDispatcher
{
    private ListenerProvider $listenerProvider;

    public function __construct(ListenerProvider $listenerProvider)
    {
        $this->listenerProvider = $listenerProvider;
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

        return $event;
    }

    public function addListener(string $eventName, ListenerInterface $listener, int $priority = 0): void
    {
        $this->listenerProvider->addListener($eventName, $listener, $priority);
    }
}
```

### 5. Asynchronous Event Dispatcher

For handling events asynchronously, let's create an AsyncEventDispatcher:

File: `src/Events/AsyncEventDispatcher.php`

```php
<?php

namespace YourFramework\Events;

use YourFramework\Queue\QueueManager;

class AsyncEventDispatcher extends EventDispatcher
{
    private QueueManager $queueManager;

    public function __construct(ListenerProvider $listenerProvider, QueueManager $queueManager)
    {
        parent::__construct($listenerProvider);
        $this->queueManager = $queueManager;
    }

    public function dispatchAsync(Event $event): void
    {
        $this->queueManager->push(new AsyncEventJob($event));
    }
}

class AsyncEventJob extends Job
{
    private Event $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function handle(EventDispatcher $dispatcher): void
    {
        $dispatcher->dispatch($this->event);
    }
}
```

### 6. Integration with Application

Let's update our Application class to use the EventDispatcher:

File: `src/Core/Application.php`

```php
<?php

namespace YourFramework\Core;

use YourFramework\Events\EventDispatcher;
use YourFramework\Events\AsyncEventDispatcher;

class Application
{
    // ... other properties

    private EventDispatcher $eventDispatcher;
    private AsyncEventDispatcher $asyncEventDispatcher;

    public function __construct(
        // ... other dependencies
        EventDispatcher $eventDispatcher,
        AsyncEventDispatcher $asyncEventDispatcher
    ) {
        // ... other initializations
        $this->eventDispatcher = $eventDispatcher;
        $this->asyncEventDispatcher = $asyncEventDispatcher;
    }

    public function dispatchEvent(Event $event): Event
    {
        return $this->eventDispatcher->dispatch($event);
    }

    public function dispatchEventAsync(Event $event): void
    {
        $this->asyncEventDispatcher->dispatchAsync($event);
    }

    // ... other methods
}
```

### 7. Example Usage

Here's an example of how to use the event system:

```php
<?php

// Define an event
class UserRegisteredEvent extends Event
{
    public function __construct(public readonly User $user) {}
}

// Define a listener
class SendWelcomeEmailListener implements ListenerInterface
{
    public function handle(Event $event): void
    {
        if ($event instanceof UserRegisteredEvent) {
            // Send welcome email logic here
            echo "Sending welcome email to: " . $event->user->email;
        }
    }
}

// In your application bootstrap or service provider
$listenerProvider = new ListenerProvider();
$listenerProvider->addListener(UserRegisteredEvent::class, new SendWelcomeEmailListener());

$eventDispatcher = new EventDispatcher($listenerProvider);
$app->setEventDispatcher($eventDispatcher);

// In your controller or service
$user = new User('john@example.com');
$event = new UserRegisteredEvent($user);
$app->dispatchEvent($event);

// For async dispatch
$app->dispatchEventAsync($event);
```

## Best Practices

1. Keep events lightweight and focused on representing what happened, not on what should happen in response.
2. Use type-hinting in listeners to ensure they only respond to specific event types.
3. Consider using event interfaces for grouping related events.
4. Use asynchronous event dispatching for time-consuming operations to avoid blocking the main application flow.
5. Implement logging for event dispatches and listener executions to aid in debugging and monitoring.

## Next Steps

1. Implement event subscribers that can listen to multiple events.
2. Create a system for conditional event listeners that only execute under certain conditions.
3. Develop a mechanism for event versioning to handle changes in event structures over time.
4. Implement event sourcing capabilities for reconstructing application state from event streams.
5. Create tools for visualizing and debugging event flows in the application.

This event system provides a flexible foundation for building loosely coupled, event-driven architectures in your framework. It allows different parts of your application to communicate and react to changes without direct dependencies, improving modularity and scalability.
