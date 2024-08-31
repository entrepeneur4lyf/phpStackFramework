<?php

namespace phpStack\Templating;

use phpStack\Container\Container;
use phpStack\Components\MainLayout;
use phpStack\Components\Header;
use phpStack\Components\Footer;
use phpStack\Components\Sidebar;

class ComponentRegistry
{
    protected $container;
    protected $components = [
        'main-layout' => MainLayout::class,
        'header' => Header::class,
        'footer' => Footer::class,
        'sidebar' => Sidebar::class,
    ];

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function register(string $name, string $componentClass): void
    {
        $this->components[$name] = $componentClass;
    }

    public function resolve(string $name, array $data = []): ComponentService
    {
        if (!isset($this->components[$name])) {
            throw new \InvalidArgumentException("Component '{$name}' is not registered.");
        }

        $componentClass = $this->components[$name];
        return $this->container->make($componentClass, ['data' => $data]);
    }

    public function render(string $name, array $data = []): string
    {
        $component = $this->resolve($name, $data);
        return $component->render();
    }
}