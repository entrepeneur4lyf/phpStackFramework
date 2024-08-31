# Phase 3 Development Guide: Templating System

## 1. Develop Base Templating Components

### ComponentService Abstract Class

First, let's create the base ComponentService class:

File: `src/Templating/ComponentService.php`

```php
<?php

namespace YourFramework\Templating;

abstract class ComponentService
{
    protected string $id;
    protected array $data;
    protected array $dependencies = [];

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

    public function setDependency(string $componentId, callable $dataProvider): void
    {
        $this->dependencies[$componentId] = $dataProvider;
    }

    public function getDependencies(): array
    {
        return $this->dependencies;
    }
}
```

### ComponentRegistry Class

Now, let's create the ComponentRegistry to manage our components:

File: `src/Templating/ComponentRegistry.php`

```php
<?php

namespace YourFramework\Templating;

class ComponentRegistry
{
    protected array $components = [];

    public function register(ComponentService $component): void
    {
        $this->components[$component->getId()] = $component;
    }

    public function get(string $id): ?ComponentService
    {
        return $this->components[$id] ?? null;
    }

    public function getAllIds(): array
    {
        return array_keys($this->components);
    }
}
```

### LayoutManager Class

Let's create the LayoutManager to handle different layouts:

File: `src/Templating/LayoutManager.php`

```php
<?php

namespace YourFramework\Templating;

class LayoutManager
{
    protected array $layouts = [];

    public function registerLayout(string $name, callable $layoutFunction): void
    {
        $this->layouts[$name] = $layoutFunction;
    }

    public function render(string $layoutName, ComponentRegistry $registry): string
    {
        if (!isset($this->layouts[$layoutName])) {
            throw new \Exception("Layout not found: $layoutName");
        }

        return ($this->layouts[$layoutName])($registry);
    }
}
```

## 2. Implement Rendering System

### RenderEngine Class

Let's create the RenderEngine to handle component rendering:

File: `src/Templating/RenderEngine.php`

```php
<?php

namespace YourFramework\Templating;

use YourFramework\Core\Config;

class RenderEngine
{
    protected ComponentRegistry $componentRegistry;
    protected Config $config;

    public function __construct(ComponentRegistry $registry, Config $config)
    {
        $this->componentRegistry = $registry;
        $this->config = $config;
    }

    public function renderComponent(string $id): string
    {
        $component = $this->componentRegistry->get($id);
        if (!$component) {
            throw new \Exception("Component not found: $id");
        }

        $cacheKey = "component_{$id}";
        if ($this->config->get('app.cache_components', false) && $this->cache()->has($cacheKey)) {
            return $this->cache()->get($cacheKey);
        }

        $rendered = $component->render();

        if ($this->config->get('app.cache_components', false)) {
            $this->cache()->set($cacheKey, $rendered);
        }

        return $rendered;
    }

    public function renderAll(): array
    {
        $rendered = [];
        foreach ($this->componentRegistry->getAllIds() as $id) {
            $rendered[$id] = $this->renderComponent($id);
        }
        return $rendered;
    }

    protected function cache()
    {
        // Implement caching mechanism here
        // This is a placeholder for now
        return new class {
            public function has($key) { return false; }
            public function get($key) { return null; }
            public function set($key, $value) {}
        };
    }
}
```

## 3. Set Up Real-time Updates

### WebSocketManager Class

Let's create a WebSocketManager to handle real-time updates:

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

### UpdateDispatcher Class

Now, let's create the UpdateDispatcher to manage component updates:

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

        foreach ($component->getDependencies() as $depId => $dataProvider) {
            $depData = $dataProvider($newData);
            $this->dispatchUpdate($depId, $depData);
        }
    }
}
```

## 4. Create Sample Components

Let's create a couple of sample components to demonstrate how to use our templating system:

File: `app/Components/HeaderComponent.php`

```php
<?php

namespace App\Components;

use YourFramework\Templating\ComponentService;

class HeaderComponent extends ComponentService
{
    public function render(): string
    {
        $title = $this->data['title'] ?? 'Default Title';
        return "<header><h1>{$title}</h1></header>";
    }
}
```

File: `app/Components/ContentComponent.php`

```php
<?php

namespace App\Components;

use YourFramework\Templating\ComponentService;

class ContentComponent extends ComponentService
{
    public function render(): string
    {
        $content = $this->data['content'] ?? 'No content available.';
        return "<main><div class='content'>{$content}</div></main>";
    }
}
```

## Integration with the Framework

Now, let's integrate these templating components into our framework:

1. Add templating configuration:

File: `config/templating.php`

```php
<?php

return [
    'cache_components' => false,
    'websocket_port' => 8080,
];
```

2. Create a TemplatingServiceProvider:

File: `src/Providers/TemplatingServiceProvider.php`

```php
<?php

namespace YourFramework\Providers;

use YourFramework\Core\ServiceProvider;
use YourFramework\Templating\ComponentRegistry;
use YourFramework\Templating\LayoutManager;
use YourFramework\Templating\RenderEngine;
use YourFramework\Templating\WebSocketManager;
use YourFramework\Templating\UpdateDispatcher;

class TemplatingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->bind(ComponentRegistry::class, function ($container) {
            return new ComponentRegistry();
        });

        $this->container->bind(LayoutManager::class, function ($container) {
            return new LayoutManager();
        });

        $this->container->bind(RenderEngine::class, function ($container) {
            return new RenderEngine(
                $container->make(ComponentRegistry::class),
                $container->make('config')
            );
        });

        $this->container->bind(WebSocketManager::class, function ($container) {
            return new WebSocketManager();
        });

        $this->container->bind(UpdateDispatcher::class, function ($container) {
            return new UpdateDispatcher(
                $container->make(ComponentRegistry::class),
                $container->make(RenderEngine::class),
                $container->make(WebSocketManager::class)
            );
        });
    }

    public function boot(): void
    {
        // Register your components here
        $registry = $this->container->make(ComponentRegistry::class);
        $registry->register(new \App\Components\HeaderComponent('header', ['title' => 'My Website']));
        $registry->register(new \App\Components\ContentComponent('content', ['content' => 'Welcome to my website!']));

        // Register your layouts here
        $layoutManager = $this->container->make(LayoutManager::class);
        $layoutManager->registerLayout('main', function ($components) {
            return "
                <!DOCTYPE html>
                <html>
                    <head>
                        <title>My Website</title>
                    </head>
                    <body>
                        {$components->get('header')->render()}
                        {$components->get('content')->render()}
                        <script src='/js/websocket.js'></script>
                    </body>
                </html>
            ";
        });
    }
}
```

3. Update your Application class to use the new TemplatingServiceProvider:

Update `src/Core/Application.php`:

```php
<?php

namespace YourFramework\Core;

use YourFramework\Providers\DatabaseServiceProvider;
use YourFramework\Providers\TemplatingServiceProvider;

class Application
{
    // ... existing code ...

    protected function registerServiceProviders(): void
    {
        $providers = [
            DatabaseServiceProvider::class,
            TemplatingServiceProvider::class,
            // ... other service providers ...
        ];

        foreach ($providers as $provider) {
            $providerInstance = new $provider($this->container);
            $providerInstance->register();
            $providerInstance->boot();
        }
    }

    // ... existing code ...
}
```

4. Create a simple WebSocket client script:

File: `public/js/websocket.js`

```javascript
const socket = new WebSocket('ws://localhost:8080');

socket.onmessage = function(event) {
    const update = JSON.parse(event.data);
    const component = document.getElementById(update.componentId);
    if (component) {
        component.innerHTML = update.html;
    }
};
```

5. Update your main application file to use the templating system:

Update `public/index.php`:

```php
<?php

require __DIR__.'/../vendor/autoload.php';

use YourFramework\Core\Application;
use YourFramework\Http\Request;
use YourFramework\Http\Response;
use YourFramework\Templating\LayoutManager;
use YourFramework\Templating\RenderEngine;

$app = new Application();

// ... existing code ...

$app->router->get('/', function (Request $request) use ($app) {
    $layoutManager = $app->container->make(LayoutManager::class);
    $renderEngine = $app->container->make(RenderEngine::class);

    $content = $layoutManager->render('main', $renderEngine);

    $response = new Response();
    return $response->setContent($content);
});

// ... existing code ...
```

This setup provides a foundation for a component-based templating system with real-time update capabilities. You can now create components, render them within layouts, and update them in real-time using WebSockets.

To fully implement this system, you'll need to:

1. Set up a WebSocket server (using a library like Ratchet or Swoole).
2. Implement the caching mechanism in the RenderEngine.
3. Create more components and layouts as needed for your application.
4. Implement security measures for WebSocket connections.

Would you like to explore any of these areas in more detail, or shall we move on to the next phase of the development roadmap?
