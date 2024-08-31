# Content Block Component Services with Real-Time Rendering

## Overview

This system transforms traditional content blocks into dynamic, service-oriented components that can be rendered and updated in real-time. Each content block becomes a self-contained service that manages its own data, rendering, and update logic.

## Key Components

1. **ComponentService**: Base class for all component services.
2. **ComponentRegistry**: Manages all component services on a page.
3. **RenderEngine**: Handles the rendering of components.
4. **UpdateDispatcher**: Manages real-time updates to components.
5. **WebSocketManager**: Handles WebSocket communication for real-time updates.

## Implementation

### ComponentService

```php
abstract class ComponentService
{
    protected $id;
    protected $data;
    protected $dependencies = [];

    public function __construct($id, $initialData = [])
    {
        $this->id = $id;
        $this->data = $initialData;
    }

    abstract public function render(): string;

    public function update($newData): void
    {
        $this->data = array_merge($this->data, $newData);
    }

    public function getDependencies(): array
    {
        return $this->dependencies;
    }

    public function setDependency($key, $value): void
    {
        $this->dependencies[$key] = $value;
    }
}
```

### ComponentRegistry

```php
class ComponentRegistry
{
    private $components = [];

    public function register(ComponentService $component): void
    {
        $this->components[$component->getId()] = $component;
    }

    public function get($id): ?ComponentService
    {
        return $this->components[$id] ?? null;
    }

    public function getAllIds(): array
    {
        return array_keys($this->components);
    }
}
```

### RenderEngine

```php
class RenderEngine
{
    private $componentRegistry;

    public function __construct(ComponentRegistry $registry)
    {
        $this->componentRegistry = $registry;
    }

    public function renderComponent($id): string
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

### UpdateDispatcher

```php
class UpdateDispatcher
{
    private $componentRegistry;
    private $renderEngine;
    private $webSocketManager;

    public function __construct(
        ComponentRegistry $registry,
        RenderEngine $engine,
        WebSocketManager $wsManager
    ) {
        $this->componentRegistry = $registry;
        $this->renderEngine = $engine;
        $this->webSocketManager = $wsManager;
    }

    public function dispatchUpdate($componentId, $newData): void
    {
        $component = $this->componentRegistry->get($componentId);
        if (!$component) {
            throw new \Exception("Component not found: $componentId");
        }

        $component->update($newData);
        $renderedHtml = $this->renderEngine->renderComponent($componentId);

        $this->webSocketManager->sendUpdate($componentId, $renderedHtml);

        // Update dependent components
        foreach ($component->getDependencies() as $depId => $depData) {
            $this->dispatchUpdate($depId, $depData);
        }
    }
}
```

### WebSocketManager

```php
class WebSocketManager
{
    private $connections = [];

    public function addConnection($connectionId, $connection): void
    {
        $this->connections[$connectionId] = $connection;
    }

    public function sendUpdate($componentId, $renderedHtml): void
    {
        $updateData = json_encode([
            'componentId' => $componentId,
            'html' => $renderedHtml
        ]);

        foreach ($this->connections as $connection) {
            $connection->send($updateData);
        }
    }
}
```

## Usage Example

```php
// Define a specific component service
class NewsComponent extends ComponentService
{
    public function render(): string
    {
        return "<div class='news'>
            <h2>{$this->data['title']}</h2>
            <p>{$this->data['content']}</p>
        </div>";
    }
}

// Set up the system
$registry = new ComponentRegistry();
$renderEngine = new RenderEngine($registry);
$webSocketManager = new WebSocketManager();
$updateDispatcher = new UpdateDispatcher($registry, $renderEngine, $webSocketManager);

// Register components
$newsComponent = new NewsComponent('news', [
    'title' => 'Breaking News',
    'content' => 'Initial news content...'
]);
$registry->register($newsComponent);

// Initial render
$initialRendered = $renderEngine->renderAll();

// When data changes
$newData = [
    'title' => 'Updated News',
    'content' => 'New exciting content!'
];
$updateDispatcher->dispatchUpdate('news', $newData);
```

## Client-Side Integration

On the client side, you'd need JavaScript to handle WebSocket updates:

```javascript
const socket = new WebSocket('ws://your-server-url');

socket.onmessage = function(event) {
    const update = JSON.parse(event.data);
    const component = document.getElementById(update.componentId);
    if (component) {
        component.innerHTML = update.html;
    }
};
```

This system allows each content block to be a self-contained service, managing its own rendering and update logic. The real-time updates are handled efficiently through WebSockets, allowing for dynamic content changes without full page reloads.
