<?php

namespace phpStack\Core;

use phpStack\Core\Container;
use PhpStack\Providers\DatabaseServiceProvider;
use phpStack\Providers\TemplatingServiceProvider;
use phpStack\Http\Request;
use phpStack\Http\Response;
use phpStack\Routing\Router;
use phpStack\Http\MiddlewarePipeline;
use Psr\Container\ContainerInterface;

class Application
{
    public Container $container;
    private static ?self $instance = null;
    protected Router $router;
    protected MiddlewarePipeline $middlewarePipeline;
    protected Config $config;

    public function __construct(?ContainerInterface $container = null)
    {
        $this->container = $container ?? new Container();
        $this->router = $container->get(Router::class);
        $this->middlewarePipeline = $container->get(MiddlewarePipeline::class);
        $this->config = $container->get(Config::class);
        $this->registerServiceProviders();
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function registerServiceProviders(): void
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

    public function bootstrap(): void
    {
        // Load configuration
        $this->loadConfiguration();
        // Register service providers
        $this->registerServiceProviders();
        // Set up error handling
        $this->setupErrorHandling();
    }

    protected function loadConfiguration(): void
    {
        $configPath = $this->container->get('config_path');
        $this->config->load($configPath . '/app.php');
        $this->config->load($configPath . '/database.php');
    }

    protected function setupErrorHandling(): void
    {
        set_exception_handler(function (\Throwable $e) {
            // Log the error
            error_log($e->getMessage());
            // You can add more sophisticated error handling here
        });
    }

    public function handle(Request $request): Response
    {
        try {
            $this->bootstrap();

            return $this->middlewarePipeline->process($request, function ($request) {
                return $this->router->dispatch($request);
            });
        } catch (\Throwable $e) {
            // Handle any uncaught exceptions
            return (new Response())->withStatus(500)->withBody(\GuzzleHttp\Psr7\Utils::streamFor('An error occurred'));
        }
    }

    public function terminate(Request $request, Response $response): void
    {
        // Perform any cleanup or logging tasks
    }

    public function run(): void
    {
        $request = Request::createFromGlobals();
        $response = $this->handle($request);
        $response->send();
        $this->terminate($request, $response);
    }
}
