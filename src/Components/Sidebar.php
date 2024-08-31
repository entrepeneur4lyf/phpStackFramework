<?php

namespace phpStack\Components;

use phpStack\Templating\ComponentService;

class Sidebar extends ComponentService
{
    public function render(): string
    {
        return <<<HTML
        <aside data-component="sidebar">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="/dashboard">Dashboard</a></li>
                <li><a href="/profile">Profile</a></li>
                <li><a href="/settings">Settings</a></li>
            </ul>
        </aside>
        HTML;
    }
}