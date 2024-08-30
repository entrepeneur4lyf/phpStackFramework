<?php

namespace phpStack\Core;

use phpStack\Http\Request;
use phpStack\Http\Response;
use phpStack\Routing\Router;

class Application
{
    protected static $instance;
    protected $container;
    protected $config;
    protected $router;

    private function __construct()
    {
        $this->container = new Container();
        $this->config = new Config();
        $this->router = new Router();

        $this->loadConfiguration();
        $this->registerCoreComponents();
    }

    public static function getInstance(): self
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    protected function loadConfiguration(): void
    {
        $this->config->load(__DIR__ . '/../../config/app.php');
    }

    protected function registerCoreComponents(): void
    {
        $this->container->singleton(Config::class, $this->config);
        $this->container->singleton(Router::class, $this->router);
    }

    public function run(): void
    {
        $request = new Request();
        $response = $this->router->dispatch($request);
        $response->send();
    }
}