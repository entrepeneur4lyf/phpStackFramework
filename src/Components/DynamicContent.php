<?php

namespace phpStack\Components;

use phpStack\Templating\ComponentService;

class DynamicContent extends ComponentService
{
    public function render(): string
    {
        $type = $this->getData('type', 'default');
        $content = $this->getContentByType($type);

        return <<<HTML
        <div data-component="dynamic-content">
            <h2>Dynamic Content</h2>
            {$content}
        </div>
        HTML;
    }

    private function getContentByType(string $type): string
    {
        switch ($type) {
            case 'welcome':
                return "<p>Welcome to our site! We're glad you're here.</p>";
            case 'team':
                return "<p>Our team consists of passionate developers and designers.</p>";
            default:
                return "<p>Click a button to load dynamic content.</p>";
        }
    }
}