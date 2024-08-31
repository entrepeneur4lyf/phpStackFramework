<?php

namespace phpStack\Core;

use phpStack\Core\Container;
use phpStack\Providers\DatabaseServiceProvider;
use phpStack\Providers\TemplatingServiceProvider;

class Application
{
    public $container;
    private static $instance;

    public function __construct()
    {
        $this->container = new Container();
        $this->registerServiceProviders();
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function registerServiceProviders()
    {
        $providers = [
            DatabaseServiceProvider::class,
            TemplatingServiceProvider::class,
            // ... other service providers ...
        ];

        foreach ($providers as $provider) {
            $instance = new $provider();
            $instance->setContainer($this->container);
            $instance->register();
        }

        foreach ($providers as $provider) {
            $instance = $this->container->get($provider);
            $instance->boot();
        }
    }

    // ... other methods ...
}
