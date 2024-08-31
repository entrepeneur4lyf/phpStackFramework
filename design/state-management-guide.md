# Phase 4 Development Guide: State Management and Persistence

## Overview

In this phase, we'll implement a robust state management and persistence system. This system will allow our framework to maintain application state across requests, handle state recovery in case of server restarts or failures, and provide a consistent state for our server-side rendered components.

## Key Components

1. **StateManager**: Central hub for managing application state.
2. **StateStore**: Interface for different state storage implementations.
3. **EventLog**: For logging state changes and enabling state reconstruction.
4. **RecoveryManager**: Handles state recovery after crashes or restarts.

## Implementation

### 1. StateManager

File: `src/State/StateManager.php`

```php
<?php

namespace YourFramework\State;

class StateManager
{
    private StateStore $stateStore;
    private EventLog $eventLog;

    public function __construct(StateStore $stateStore, EventLog $eventLog)
    {
        $this->stateStore = $stateStore;
        $this->eventLog = $eventLog;
    }

    public function get(string $key, $default = null)
    {
        return $this->stateStore->get($key) ?? $default;
    }

    public function set(string $key, $value): void
    {
        $this->stateStore->set($key, $value);
        $this->eventLog->logEvent('state_change', [
            'key' => $key,
            'new_value' => $value
        ]);
    }

    public function delete(string $key): void
    {
        $this->stateStore->delete($key);
        $this->eventLog->logEvent('state_delete', [
            'key' => $key
        ]);
    }
}
```

### 2. StateStore Interface and Implementations

File: `src/State/StateStore.php`

```php
<?php

namespace YourFramework\State;

interface StateStore
{
    public function get(string $key);
    public function set(string $key, $value): void;
    public function delete(string $key): void;
}
```

File: `src/State/RedisStateStore.php`

```php
<?php

namespace YourFramework\State;

use Redis;

class RedisStateStore implements StateStore
{
    private Redis $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    public function get(string $key)
    {
        $value = $this->redis->get($key);
        return $value !== false ? unserialize($value) : null;
    }

    public function set(string $key, $value): void
    {
        $this->redis->set($key, serialize($value));
    }

    public function delete(string $key): void
    {
        $this->redis->del($key);
    }
}
```

### 3. EventLog

File: `src/State/EventLog.php`

```php
<?php

namespace YourFramework\State;

use PDO;

class EventLog
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function logEvent(string $eventType, array $eventData): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO event_log (event_type, event_data, created_at) VALUES (?, ?, ?)");
        $stmt->execute([$eventType, json_encode($eventData), date('Y-m-d H:i:s')]);
    }

    public function getEvents(?\DateTime $since = null): array
    {
        $query = "SELECT * FROM event_log";
        $params = [];

        if ($since) {
            $query .= " WHERE created_at > ?";
            $params[] = $since->format('Y-m-d H:i:s');
        }

        $query .= " ORDER BY created_at ASC";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
```

### 4. RecoveryManager

File: `src/State/RecoveryManager.php`

```php
<?php

namespace YourFramework\State;

class RecoveryManager
{
    private StateStore $stateStore;
    private EventLog $eventLog;

    public function __construct(StateStore $stateStore, EventLog $eventLog)
    {
        $this->stateStore = $stateStore;
        $this->eventLog = $eventLog;
    }

    public function recover(\DateTime $since): void
    {
        $events = $this->eventLog->getEvents($since);

        foreach ($events as $event) {
            $eventData = json_decode($event['event_data'], true);

            switch ($event['event_type']) {
                case 'state_change':
                    $this->stateStore->set($eventData['key'], $eventData['new_value']);
                    break;
                case 'state_delete':
                    $this->stateStore->delete($eventData['key']);
                    break;
            }
        }
    }
}
```

### 5. Integration with Application

Update your `Application` class to use the StateManager:

File: `src/Core/Application.php`

```php
<?php

namespace YourFramework\Core;

use YourFramework\State\StateManager;

class Application
{
    // ... other properties

    private StateManager $stateManager;

    public function __construct(StateManager $stateManager)
    {
        $this->stateManager = $stateManager;
        // ... other initialization
    }

    public function getState(string $key, $default = null)
    {
        return $this->stateManager->get($key, $default);
    }

    public function setState(string $key, $value): void
    {
        $this->stateManager->set($key, $value);
    }

    // ... other methods
}
```

### 6. Using State in Components

Update your component base class to access the state:

File: `src/Templating/ComponentService.php`

```php
<?php

namespace YourFramework\Templating;

use YourFramework\Core\Application;

abstract class ComponentService
{
    protected string $id;
    protected array $data;
    protected Application $app;

    public function __construct(string $id, Application $app, array $initialData = [])
    {
        $this->id = $id;
        $this->app = $app;
        $this->data = $initialData;
    }

    protected function getState(string $key, $default = null)
    {
        return $this->app->getState($key, $default);
    }

    protected function setState(string $key, $value): void
    {
        $this->app->setState($key, $value);
    }

    // ... other methods
}
```

### 7. Example Usage in a Component

Here's how you might use the state management in a component:

File: `app/Components/UserProfileComponent.php`

```php
<?php

namespace App\Components;

use YourFramework\Templating\ComponentService;

class UserProfileComponent extends ComponentService
{
    public function render(): string
    {
        $userId = $this->getState('current_user_id');
        $user = $this->fetchUserData($userId);

        return "<div id='{$this->getId()}'>
            <h2>{$user['name']}'s Profile</h2>
            <p>Email: {$user['email']}</p>
        </div>";
    }

    private function fetchUserData($userId)
    {
        // Fetch user data from database or cache
    }
}
```

## How It Works

1. The `StateManager` provides a centralized way to manage application state.
2. State changes are persisted in the `StateStore` (e.g., Redis) for quick access.
3. All state changes are logged in the `EventLog` for auditing and recovery purposes.
4. The `RecoveryManager` can reconstruct the state from the event log if needed.
5. Components can access and modify the state through the `Application` instance.

## Best Practices

1. Use state for data that needs to persist across requests or be shared between components.
2. Keep the state as small and simple as possible to avoid performance issues.
3. Use the event log for critical state changes that need to be audited or recovered.
4. Implement proper error handling and logging in the state management system.
5. Consider implementing a caching layer for frequently accessed state data.

## Next Steps

1. Implement a mechanism to clean up old events from the event log.
2. Add support for transactions in the state management system.
3. Implement state versioning to handle conflicts in concurrent updates.
4. Create a dashboard for monitoring and managing application state.
5. Integrate the state management system with the WebSocket server for real-time state synchronization.

This state management and persistence system provides a robust foundation for maintaining application state in your server-side rendering framework. It allows for efficient state access, logging of state changes, and recovery in case of server issues.
