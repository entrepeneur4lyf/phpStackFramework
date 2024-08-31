<?php

namespace phpStack\Templating;

class LayoutManager
{
    protected $layouts = [];
    protected $componentRegistry;

    public function __construct(ComponentRegistry $componentRegistry)
    {
        $this->componentRegistry = $componentRegistry;
    }

    public function registerLayout(string $name, string $componentName): void
    {
        $this->layouts[$name] = $componentName;
    }

    public function render(string $layoutName, array $data = []): string
    {
        if (!isset($this->layouts[$layoutName])) {
            throw new \InvalidArgumentException("Layout '{$layoutName}' is not registered.");
        }

        $componentName = $this->layouts[$layoutName];
        return $this->componentRegistry->render($componentName, $data);
    }
}