<?php

namespace phpStack\Core;

use phpStack\Core\Container;
use phpStack\Providers\DatabaseServiceProvider;
use phpStack\Providers\TemplatingServiceProvider;

class Application
{
    public $container;  // Changed from protected to public for easier access

    public function __construct()  // Changed from private to public
    {
        $this->container = new Container();
        $this->registerServiceProviders();
    }

    protected function registerServiceProviders()
    {
        $providers = [
            DatabaseServiceProvider::class,
            TemplatingServiceProvider::class,
            // ... other service providers ...
        ];

        foreach ($providers as $provider) {
            $instance = new $provider($this->container);
            $instance->register();
        }

        foreach ($providers as $provider) {
            $instance = $this->container->get($provider);
            $instance->boot();
        }
    }

    // ... other methods ...
}
