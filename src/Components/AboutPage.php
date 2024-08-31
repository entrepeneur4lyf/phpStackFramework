<?php

namespace phpStack\Components;

use phpStack\Templating\ComponentService;

class AboutPage extends ComponentService
{
    public function render(): string
    {
        return <<<HTML
        <div data-component="about-page">
            <h1>About Us</h1>
            <p>We are a company dedicated to creating amazing web experiences.</p>
            <button hx-post="/team" hx-target="#dynamic-content" hx-swap="innerHTML">
                Load Team Info
            </button>
        </div>
        HTML;
    }
}
