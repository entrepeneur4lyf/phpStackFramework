<?php

namespace phpStack\Components;

use phpStack\Templating\ComponentService;

class Header extends ComponentService
{
    public function render(): string
    {
        return <<<HTML
        <header data-component="header">
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </nav>
        </header>
        HTML;
    }
}