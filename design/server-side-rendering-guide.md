# Development Guide: Server-Side Rendering with Real-Time Updates

## Overview

In this approach, all rendering occurs on the server. The server pushes complete HTML updates to the client, which simply replaces the existing content with the new HTML. This method keeps the client-side logic minimal and puts the rendering responsibility entirely on the server.

## Key Components

1. **ComponentService**: Base class for all components.
2. **RenderEngine**: Handles the rendering of components.
3. **UpdateDispatcher**: Manages updates and triggers re-renders.
4. **WebSocketManager**: Sends HTML updates to the client.
5. **Minimal Client-Side Script**: Receives updates and replaces HTML.

## Implementation

### 1. ComponentService

File: `src/Templating/ComponentService.php`

```php
<?php

namespace YourFramework\Templating;

abstract class ComponentService
{
    protected string $id;
    protected array $data;

    public function __construct(string $id, array $initialData = [])
    {
        $this->id = $id;
        $this->data = $initialData;
    }

    abstract public function render(): string;

    public function update(array $newData): void
    {
        $this->data = array_merge($this->data, $newData);
    }

    public function getId(): string
    {
        return $this->id;
    }
}
```

### 2. RenderEngine

File: `src/Templating/RenderEngine.php`

```php
<?php

namespace YourFramework\Templating;

class RenderEngine
{
    protected ComponentRegistry $componentRegistry;

    public function __construct(ComponentRegistry $registry)
    {
        $this->componentRegistry = $registry;
    }

    public function renderComponent(string $id): string
    {
        $component = $this->componentRegistry->get($id);
        if (!$component) {
            throw new \Exception("Component not found: $id");
        }

        return $component->render();
    }

    public function renderAll(): array
    {
        $rendered = [];
        foreach ($this->componentRegistry->getAllIds() as $id) {
            $rendered[$id] = $this->renderComponent($id);
        }
        return $rendered;
    }
}
```

### 3. UpdateDispatcher

File: `src/Templating/UpdateDispatcher.php`

```php
<?php

namespace YourFramework\Templating;

class UpdateDispatcher
{
    protected ComponentRegistry $componentRegistry;
    protected RenderEngine $renderEngine;
    protected WebSocketManager $webSocketManager;

    public function __construct(
        ComponentRegistry $registry,
        RenderEngine $engine,
        WebSocketManager $wsManager
    ) {
        $this->componentRegistry = $registry;
        $this->renderEngine = $engine;
        $this->webSocketManager = $wsManager;
    }

    public function dispatchUpdate(string $componentId, array $newData): void
    {
        $component = $this->componentRegistry->get($componentId);
        if (!$component) {
            throw new \Exception("Component not found: $componentId");
        }

        $component->update($newData);
        $renderedHtml = $this->renderEngine->renderComponent($componentId);

        $this->webSocketManager->sendUpdate($componentId, $renderedHtml);
    }
}
```

### 4. WebSocketManager

File: `src/Templating/WebSocketManager.php`

```php
<?php

namespace YourFramework\Templating;

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

    public function sendUpdate(string $componentId, string $renderedHtml): void
    {
        $update = json_encode([
            'componentId' => $componentId,
            'html' => $renderedHtml
        ]);

        foreach ($this->clients as $client) {
            $client->send($update);
        }
    }
}
```

### 5. Minimal Client-Side Script

File: `public/js/websocket-updater.js`

```javascript
class WebSocketUpdater {
    constructor(url) {
        this.socket = new WebSocket(url);
        this.socket.onmessage = this.handleMessage.bind(this);
    }

    handleMessage(event) {
        const update = JSON.parse(event.data);
        const component = document.getElementById(update.componentId);
        if (component) {
            component.innerHTML = update.html;
        }
    }
}

// Usage
const wsUpdater = new WebSocketUpdater('ws://localhost:8080');
```

### 6. Sample Component

File: `app/Components/CounterComponent.php`

```php
<?php

namespace App\Components;

use YourFramework\Templating\ComponentService;

class CounterComponent extends ComponentService
{
    public function render(): string
    {
        $count = $this->data['count'] ?? 0;
        return "<div id='{$this->getId()}'>
            <h2>Counter: {$count}</h2>
            <button onclick='incrementCounter()'>Increment</button>
        </div>";
    }
}
```

### 7. Setup in Application

Update your `TemplatingServiceProvider` or equivalent:

```php
public function boot(): void
{
    $registry = $this->container->make(ComponentRegistry::class);
    $registry->register(new CounterComponent('counter', ['count' => 0]));

    // ... other component registrations ...
}
```

### 8. Route for Counter Increment

Add to your `routes/api.php`:

```php
$router->post('/increment-counter', function (Request $request) use ($app) {
    $updateDispatcher = $app->container->make(UpdateDispatcher::class);
    $registry = $app->container->make(ComponentRegistry::class);
    
    $counter = $registry->get('counter');
    $currentCount = $counter->data['count'] ?? 0;
    $newCount = $currentCount + 1;
    
    $updateDispatcher->dispatchUpdate('counter', ['count' => $newCount]);

    return new Response('Counter incremented');
});
```

### 9. Main Layout

Update your main layout:

```php
$layoutManager->registerLayout('main', function ($components) {
    return "
        <!DOCTYPE html>
        <html>
            <head>
                <title>Server-Side Rendering Demo</title>
            </head>
            <body>
                {$components->get('counter')->render()}
                <script src='/js/websocket-updater.js'></script>
                <script>
                    function incrementCounter() {
                        fetch('/increment-counter', {method: 'POST'})
                            .then(response => console.log('Counter incremented'));
                    }
                </script>
            </body>
        </html>
    ";
});
```

## How It Works

1. All components are rendered on the server.
2. When a component's data changes (e.g., counter increment), the server re-renders only that component.
3. The server sends the newly rendered HTML for the component via WebSocket.
4. The client receives the update and simply replaces the existing component's HTML with the new HTML.

This approach keeps all rendering logic on the server, with the client only responsible for replacing HTML content when updates are received.

## Testing

1. Start your PHP server and WebSocket server.
2. Open the page in a browser. You'll see the counter component.
3. Click the "Increment" button. This sends a POST request to `/increment-counter`.
4. The server processes the request, updates the component state, re-renders the component, and sends the new HTML via WebSocket.
5. The client receives the update and replaces the component's HTML.
6. The counter value updates without any client-side rendering or page reload.

This server-side rendering approach with real-time updates provides a thin client solution while still allowing for dynamic, real-time web applications.
