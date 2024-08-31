<?php

namespace phpStack\Components;

use phpStack\Templating\ComponentService;

class MainLayout extends ComponentService
{
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
            <div data-component="header"></div>
            <div class="container">
                <div data-component="sidebar"></div>
                <main>
                    {$this->getData('content')}
                </main>
            </div>
            <div data-component="footer"></div>
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
