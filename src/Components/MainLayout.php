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
        <body hx-boost="true">
            {$this->componentRegistry->render('header')}
            <div class="container">
                {$this->componentRegistry->render('sidebar')}
                <main id="main-content" hx-trigger="load" hx-get="/home" hx-swap="innerHTML">
                    {$mainContent}
                </main>
            </div>
            {$this->componentRegistry->render('footer')}
            <script src="https://unpkg.com/htmx.org@1.9.10"></script>
            <script src="https://unpkg.com/htmx.org/dist/ext/ws.js"></script>
            <script>
                document.body.addEventListener('htmx:wsConnected', function(event) {
                    console.log('WebSocket Connected!');
                });
                document.body.addEventListener('htmx:wsError', function(event) {
                    console.error('WebSocket Error:', event.detail.error);
                });
                document.body.addEventListener('htmx:afterSettle', function(event) {
                    if (event.detail.target.id === 'main-content') {
                        history.pushState({}, '', event.detail.pathInfo.requestPath);
                    }
                });
            </script>
        </body>
        </html>
        HTML;
    }
}
