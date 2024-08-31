# Development Guide: Implementing Diff-Based Templating

## 1. Implement the DiffEngine

First, let's create a `DiffEngine` class that calculates the differences between two HTML strings. We'll use a simple line-based diff algorithm for this example.

File: `src/Templating/DiffEngine.php`

```php
<?php

namespace YourFramework\Templating;

class DiffEngine
{
    public function calculateDiff(string $oldHtml, string $newHtml): array
    {
        $oldLines = explode("\n", $oldHtml);
        $newLines = explode("\n", $newHtml);
        
        $diff = [];
        $maxLen = max(count($oldLines), count($newLines));
        
        for ($i = 0; $i < $maxLen; $i++) {
            $oldLine = $oldLines[$i] ?? null;
            $newLine = $newLines[$i] ?? null;
            
            if ($oldLine !== $newLine) {
                $diff[] = [
                    'index' => $i,
                    'oldLine' => $oldLine,
                    'newLine' => $newLine
                ];
            }
        }
        
        return $diff;
    }
}
```

## 2. Update the RenderEngine

Next, let's update our `RenderEngine` to support diff generation:

File: `src/Templating/RenderEngine.php`

```php
<?php

namespace YourFramework\Templating;

use YourFramework\Core\Config;

class RenderEngine
{
    protected ComponentRegistry $componentRegistry;
    protected Config $config;
    protected DiffEngine $diffEngine;
    protected array $lastRendered = [];

    public function __construct(ComponentRegistry $registry, Config $config, DiffEngine $diffEngine)
    {
        $this->componentRegistry = $registry;
        $this->config = $config;
        $this->diffEngine = $diffEngine;
    }

    public function renderComponent(string $id, bool $generateDiff = false): array
    {
        $component = $this->componentRegistry->get($id);
        if (!$component) {
            throw new \Exception("Component not found: $id");
        }

        $rendered = $component->render();

        if ($generateDiff) {
            $diff = $this->diffEngine->calculateDiff($this->lastRendered[$id] ?? '', $rendered);
            $this->lastRendered[$id] = $rendered;
            return [
                'diff' => $diff,
                'fullHtml' => $rendered
            ];
        }

        return [
            'diff' => null,
            'fullHtml' => $rendered
        ];
    }

    // ... other methods ...
}
```

## 3. Update the WebSocketManager

Now, let's update our `WebSocketManager` to send diffs:

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

    public function sendUpdate(string $componentId, array $renderResult): void
    {
        $update = json_encode([
            'componentId' => $componentId,
            'diff' => $renderResult['diff'],
            'fullHtml' => $renderResult['fullHtml']
        ]);

        foreach ($this->clients as $client) {
            $client->send($update);
        }
    }
}
```

## 4. Update the UpdateDispatcher

Let's update our `UpdateDispatcher` to use the new diff-based rendering:

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
        $renderResult = $this->renderEngine->renderComponent($componentId, true);

        $this->webSocketManager->sendUpdate($componentId, $renderResult);

        foreach ($component->getDependencies() as $depId => $dataProvider) {
            $depData = $dataProvider($newData);
            $this->dispatchUpdate($depId, $depData);
        }
    }
}
```

## 5. Implement Client-Side Diff Application

Create a new JavaScript file to handle WebSocket connections and apply diffs:

File: `public/js/websocket-diff.js`

```javascript
class WebSocketDiffManager {
    constructor(url) {
        this.socket = new WebSocket(url);
        this.socket.onmessage = this.handleMessage.bind(this);
    }

    handleMessage(event) {
        const update = JSON.parse(event.data);
        const component = document.getElementById(update.componentId);
        if (component) {
            if (update.diff && update.diff.length > 0) {
                this.applyDiff(component, update.diff);
            } else {
                component.innerHTML = update.fullHtml;
            }
        }
    }

    applyDiff(element, diff) {
        const lines = element.innerHTML.split('\n');
        
        for (const change of diff) {
            if (change.newLine === null) {
                // Line removed
                lines.splice(change.index, 1);
            } else if (change.oldLine === null) {
                // Line added
                lines.splice(change.index, 0, change.newLine);
            } else {
                // Line changed
                lines[change.index] = change.newLine;
            }
        }
        
        element.innerHTML = lines.join('\n');
    }
}

// Usage
const wsManager = new WebSocketDiffManager('ws://localhost:8080');
```

## 6. Create a Sample Component

Let's create a sample component to demonstrate the diff-based updates:

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

## 7. Set Up the Component in Your Application

Update your `TemplatingServiceProvider` or equivalent to register the new component:

```php
public function boot(): void
{
    $registry = $this->container->make(ComponentRegistry::class);
    $registry->register(new CounterComponent('counter', ['count' => 0]));

    // ... other component registrations ...
}
```

## 8. Create a Route to Handle Counter Increments

Add a new route in your `routes/api.php` file:

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

## 9. Update Your Main Layout

Update your main layout to include the new WebSocket script and the counter component:

```php
$layoutManager->registerLayout('main', function ($components) {
    return "
        <!DOCTYPE html>
        <html>
            <head>
                <title>Diff-Based Templating Demo</title>
            </head>
            <body>
                {$components->get('counter')->render()}
                <script src='/js/websocket-diff.js'></script>
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

## Testing the Diff-Based Templating System

1. Start your PHP server and WebSocket server.
2. Open the page in a browser. You should see the counter component with a value of 0.
3. Click the "Increment" button. This will send a POST request to `/increment-counter`.
4. The server will process the request, update the component state, and send a diff update via WebSocket.
5. The client-side JavaScript will receive the update and apply the diff to the DOM.
6. You should see the counter value increment without a full page reload.

## Debugging Tips

1. Use browser developer tools to monitor WebSocket messages.
2. Add console.log statements in the client-side JavaScript to see the diffs being applied.
3. On the server-side, log the diffs being generated to understand how the system is working.

This implementation demonstrates a basic diff-based templating system. In a production environment, you'd want to add error handling, optimize the diff algorithm, and possibly implement a more robust state management system.
