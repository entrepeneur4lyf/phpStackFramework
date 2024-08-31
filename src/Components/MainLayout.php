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
                    {$this->getData('content')}
                </main>
            </div>
            {$this->componentRegistry->render('footer')}
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
