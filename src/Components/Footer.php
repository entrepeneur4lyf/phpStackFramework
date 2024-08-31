<?php

namespace phpStack\Components;

use phpStack\Templating\ComponentService;

class Footer extends ComponentService
{
    public function render(): string
    {
        $currentYear = date('Y');
        return <<<HTML
        <footer data-component="footer">
            <p>&copy; {$currentYear} My App. All rights reserved.</p>
        </footer>
        HTML;
    }
}