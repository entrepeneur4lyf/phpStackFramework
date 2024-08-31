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
            <button onclick="wsHandler.requestUpdate('dynamic-content', {type: 'team'})">
                Load Team Info
            </button>
        </div>
        HTML;
    }
}<?php

namespace phpStack\Components;

use phpStack\Templating\ComponentService;

class AboutPage extends ComponentService
{
    public function render(): string
    {
        return '<h2>About phpStack Framework</h2><p>This is a powerful and flexible PHP framework.</p>';
    }
}
