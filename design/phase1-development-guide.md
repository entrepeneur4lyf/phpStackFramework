# Phase 1 Development Guide: Foundation and Core Components

## 1. Set up project structure

First, let's create the basic directory structure for your framework:

```bash
mkdir -p your-framework/{src/{Core,Http,Routing},config,public,tests}
cd your-framework
```

Now, let's initialize the Git repository and create the initial composer.json file:

```bash
git init
composer init
```

When prompted, set the namespace to `YourFramework` and choose PSR-4 for autoloading.

Edit the `composer.json` file to set up autoloading:

```json
{
    "name": "your-namespace/your-framework",
    "description": "Your custom PHP framework",
    "type": "library",
    "require": {
        "php": "^7.4|^8.0"
    },
    "autoload": {
        "psr-4": {
            "YourFramework\\": "src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "YourFramework\\Tests\\": "tests/"
        }
    },
    "require-dev": {
        "phpunit/phpunit": "^9.5"
    }
}
```

Run `composer install` to set up the autoloader.

## 2. Develop Core components

Let's start with the `Application` class:

File: `src/Core/Application.php`

```php
<?php

namespace YourFramework\Core;

class Application
{
    protected Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function boot(): void
    {
        // Boot essential services
    }

    public function run(): void
    {
        // Handle the request and send the response
    }

    public function terminate(): void
    {
        // Perform cleanup tasks
    }
}
```

Now, let's create the `Container` class:

File: `src/Core/Container.php`

```php
<?php

namespace YourFramework\Core;

use Closure;
use ReflectionClass;
use Exception;

class Container
{
    protected array $bindings = [];

    public function bind(string $abstract, $concrete = null): void
    {
        if (is_null($concrete)) {
            $concrete = $abstract;
        }
        $this->bindings[$abstract] = $concrete;
    }

    public function make(string $abstract)
    {
        $concrete = $this->bindings[$abstract] ?? $abstract;

        if ($concrete instanceof Closure) {
            return $concrete($this);
        }

        $reflector = new ReflectionClass($concrete);
        if (!$reflector->isInstantiable()) {
            throw new Exception("Class {$concrete} is not instantiable");
        }

        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return new $concrete;
        }

        $dependencies = $constructor->getParameters();
        $instances = $this->resolveDependencies($dependencies);

        return $reflector->newInstanceArgs($instances);
    }

    protected function resolveDependencies(array $dependencies): array
    {
        $results = [];

        foreach ($dependencies as $dependency) {
            $results[] = $this->make($dependency->getType()->getName());
        }

        return $results;
    }
}
```

Next, let's create the `ServiceProvider` abstract class:

File: `src/Core/ServiceProvider.php`

```php
<?php

namespace YourFramework\Core;

abstract class ServiceProvider
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    abstract public function register(): void;

    public function boot(): void
    {
        // Optional boot method
    }
}
```

Finally, let's create the `Module` abstract class:

File: `src/Core/Module.php`

```php
<?php

namespace YourFramework\Core;

abstract class Module
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    abstract public function register(): void;

    public function boot(): void
    {
        // Optional boot method
    }
}
```

## 3. Implement HTTP handling

Let's create basic `Request` and `Response` classes:

File: `src/Http/Request.php`

```php
<?php

namespace YourFramework\Http;

class Request
{
    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function uri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function get(string $key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    public function post(string $key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }
}
```

File: `src/Http/Response.php`

```php
<?php

namespace YourFramework\Http;

class Response
{
    protected int $statusCode = 200;
    protected array $headers = [];
    protected string $content = '';

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function send(): void
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        echo $this->content;
    }
}
```

## 4. Develop Routing system

Let's create a basic `Router` class:

File: `src/Routing/Router.php`

```php
<?php

namespace YourFramework\Routing;

use YourFramework\Http\Request;
use YourFramework\Core\Container;

class Router
{
    protected array $routes = [];

    public function get(string $uri, $action): void
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, $action): void
    {
        $this->addRoute('POST', $uri, $action);
    }

    protected function addRoute(string $method, string $uri, $action): void
    {
        $this->routes[$method][$uri] = $action;
    }

    public function dispatch(Request $request, Container $container)
    {
        $method = $request->method();
        $uri = $request->uri();

        $action = $this->routes[$method][$uri] ?? null;

        if (!$action) {
            throw new \Exception('Route not found');
        }

        if (is_callable($action)) {
            return $action($request);
        }

        if (is_array($action) && count($action) === 2) {
            [$controller, $method] = $action;
            $controllerInstance = $container->make($controller);
            return $controllerInstance->$method($request);
        }

        throw new \Exception('Invalid route action');
    }
}
```

## 5. Set up basic configuration system

Create a simple configuration loader:

File: `src/Core/Config.php`

```php
<?php

namespace YourFramework\Core;

class Config
{
    protected array $config = [];

    public function load(string $path): void
    {
        $this->config = require $path;
    }

    public function get(string $key, $default = null)
    {
        $keys = explode('.', $key);
        $value = $this->config;

        foreach ($keys as $subKey) {
            if (!isset($value[$subKey])) {
                return $default;
            }
            $value = $value[$subKey];
        }

        return $value;
    }
}
```

Now, let's create a sample configuration file:

File: `config/app.php`

```php
<?php

return [
    'name' => 'Your Framework',
    'debug' => true,
    'url' => 'http://localhost',
];
```

## Bootstrap the Framework

Finally, let's create a bootstrap file to tie everything together:

File: `public/index.php`

```php
<?php

require __DIR__.'/../vendor/autoload.php';

use YourFramework\Core\Application;
use YourFramework\Core\Config;
use YourFramework\Http\Request;
use YourFramework\Http\Response;
use YourFramework\Routing\Router;

$app = new Application();

// Load configuration
$config = new Config();
$config->load(__DIR__.'/../config/app.php');
$app->container->bind(Config::class, $config);

// Set up router
$router = new Router();
$app->container->bind(Router::class, $router);

// Define routes
$router->get('/', function (Request $request) {
    $response = new Response();
    return $response->setContent('Hello, World!');
});

// Run the application
$app->boot();

$request = new Request();
$response = $app->container->make(Router::class)->dispatch($request, $app->container);
$response->send();

$app->terminate();
```

This bootstrap file sets up the basic structure of your framework and demonstrates how the components work together. You can now run your framework by setting up a web server to point to the `public` directory.

To test your framework, you can use PHP's built-in server:

```bash
php -S localhost:8000 -t public
```

Visit `http://localhost:8000` in your browser, and you should see "Hello, World!".

This completes the foundation and core components of your framework. In the next phases, we'll build upon this structure to add more advanced features.
