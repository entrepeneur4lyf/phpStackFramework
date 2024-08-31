# Diff-Based Templating System

## Overview

In a diff-based templating approach, instead of sending the entire rendered HTML for a component when it updates, we send only the differences (or "diff") between the old and new versions. The client-side then applies these differences to update the DOM.

## Key Components

1. **DiffEngine**: Calculates the differences between two HTML strings.
2. **PatchApplier**: Applies the diff to the existing DOM on the client-side.
3. **UpdatedRenderEngine**: Extends the existing RenderEngine to support diff generation.
4. **UpdatedWebSocketManager**: Sends diffs instead of full HTML.
5. **UpdatedClientScript**: Applies diffs to the DOM.

## Implementation

### 1. DiffEngine

Let's create a DiffEngine class that calculates the differences between two HTML strings:

File: `src/Templating/DiffEngine.php`

```php
<?php

namespace YourFramework\Templating;

class DiffEngine
{
    public function calculateDiff(string $oldHtml, string $newHtml): array
    {
        // For this example, we'll use a simple line-based diff
        // In a real-world scenario, you might want to use a more sophisticated diff algorithm
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

### 2. Updated RenderEngine

Let's update our RenderEngine to support diff generation:

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

    public function renderComponent(string $id, bool $generateDiff = false): string|array
    {
        $component = $this->componentRegistry->get($id);
        if (!$component) {
            throw new \Exception("Component not found: $id");
        }

        $rendered = $component->render();

        if ($generateDiff) {
            $diff = $this->diffEngine->calculateDiff($this->lastRendered[$id] ?? '', $rendered);
            $this->lastRendered[$id] = $rendered;
            return ['diff' => $diff, 'fullHtml' => $rendered];
        }

        return $rendered;
    }

    // ... other methods ...
}
```

### 3. Updated WebSocketManager

Let's update our WebSocketManager to send diffs:

File: `src/Templating/WebSocketManager.php`

```php
<?php

namespace YourFramework\Templating;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketManager implements MessageComponentInterface
{
    // ... existing methods ...

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

### 4. Updated UpdateDispatcher

Let's update our UpdateDispatcher to use the new diff-based rendering:

File: `src/Templating/UpdateDispatcher.php`

```php
<?php

namespace YourFramework\Templating;

class UpdateDispatcher
{
    // ... existing properties and constructor ...

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

### 5. Updated Client-Side Script

Let's update our client-side script to apply diffs:

File: `public/js/websocket.js`

```javascript
const socket = new WebSocket('ws://localhost:8080');

socket.onmessage = function(event) {
    const update = JSON.parse(event.data);
    const component = document.getElementById(update.componentId);
    if (component) {
        if (update.diff && update.diff.length > 0) {
            applyDiff(component, update.diff);
        } else {
            component.innerHTML = update.fullHtml;
        }
    }
};

function applyDiff(element, diff) {
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
```

## Benefits of this Approach

1. **Reduced Network Traffic**: Only the changes are sent over the network, which can significantly reduce bandwidth usage, especially for large components with small changes.

2. **Faster Updates**: Applying small diffs to the DOM is often faster than replacing the entire content, leading to quicker updates and a more responsive user interface.

3. **Reduced Server Load**: Generating diffs can be less resource-intensive than repeatedly rendering entire components, especially for complex templates.

4. **Improved User Experience**: Smaller, more focused updates can lead to less visual disruption and a smoother user experience.

## Considerations and Next Steps

1. **Diff Algorithm**: The simple line-based diff algorithm used here is for illustration. In a production environment, you'd want to use a more sophisticated algorithm that can handle structural changes in the DOM more effectively.

2. **Performance Optimization**: For very large components, you might want to implement a threshold where if the diff is larger than a certain size, you send the full HTML instead.

3. **Error Handling**: Implement robust error handling for cases where applying a diff fails, falling back to full HTML replacement.

4. **State Management**: Consider implementing a client-side state management system to work alongside the diff-based updates for more complex applications.

5. **Testing**: Develop comprehensive tests for the diff generation and application process to ensure reliability.

6. **Compatibility**: Ensure that this system works well with all major browsers and degrades gracefully for unsupported clients.

This diff-based approach adds a layer of complexity to your templating system, but the benefits in terms of performance and user experience can be significant, especially for applications with frequent updates or large, complex components.
