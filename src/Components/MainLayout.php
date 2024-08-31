<?php

namespace phpStack\Components;

use phpStack\Templating\ComponentService;

class MainLayout extends ComponentService
{
    protected $componentRegistry;

    public function __construct($componentRegistry)
    {
        $this->componentRegistry = $componentRegistry;
    }

    public function render(): string
    {
        $content = $this->getData('content');
        if (is_string($content)) {
            $mainContent = $content;
        } elseif ($content instanceof ComponentService) {
            $mainContent = $content->render();
        } else {
            $mainContent = '<p>No content available.</p>';
        }

        return <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>{$this->getData('title', 'My App')}</title>
            <link rel="stylesheet" href="/css/main.css">
            <link rel="icon" href="/favicon.ico" type="image/x-icon">
        </head>
        <body>
            {$this->componentRegistry->render('header')}
            <div class="container">
                {$this->componentRegistry->render('sidebar')}
                <main>
                    {$mainContent}
                    <div id="dynamic-content"></div>
                </main>
            </div>
            {$this->componentRegistry->render('footer')}
            <div id="dynamic-content"></div>
            <script src="/js/websocket-handler.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.wsHandler = new WebSocketHandler('ws://localhost:8080');
                });
            </script>
        </body>
        </html>
        HTML;
    }
}
