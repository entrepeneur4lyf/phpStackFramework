<?php

namespace phpStack\Components;

use phpStack\Templating\ComponentService;

class HomePage extends ComponentService
{
    public function render(): string
    {
        return <<<HTML
        <div data-component="home-page" hx-ext="ws">
            <h1>Welcome to Our Website</h1>
            <p>This is a sample home page using our new templating system.</p>
            <button hx-post="/welcome" hx-target="#dynamic-content" hx-swap="innerHTML">
                Load Welcome Message
            </button>
            <div id="dynamic-content"></div>
        </div>
        HTML;
    }
}
