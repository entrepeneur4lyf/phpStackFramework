<?php

namespace phpStack;

use phpStack\Core\Container;
use phpStack\Providers\DatabaseServiceProvider;
use phpStack\Providers\TemplatingServiceProvider;

class Application
{
    protected $container;

    public function __construct()
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
