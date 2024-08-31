<?php

namespace phpStack\Routing;

use phpStack\Http\Request;
use phpStack\Http\Response;

class Router
{
    protected array $routes = [];

    public function addRoute(string $method, string $uri, $handler): Route
    {
        $route = new Route($method, $uri, $handler);
        $this->routes[] = $route;
        return $route;
    }

    public function get(string $uri, $handler): Route
    {
        return $this->addRoute('GET', $uri, $handler);
    }

    public function post(string $uri, $handler): Route
    {
        return $this->addRoute('POST', $uri, $handler);
    }

    public function match(Request $request): ?Route
    {
        foreach ($this->routes as $route) {
            if ($this->pathMatches($route->getUri(), $request->getUri()->getPath())) {
                return $route;
            }
        }

        return null;
    }

    protected function pathMatches(string $routePath, string $requestPath): bool
    {
        // Implementation
    }

    protected function isParameter(string $segment): bool
    {
        // Implementation
    }

    protected function executeHandler($handler, Request $request): Response
    {
        // Implementation
    }
}

use PhpStack\Http\Request as HttpRequest;
use PhpStack\Http\Response as HttpResponse;
use Exception;

class Router
{
    protected array $routes = [];

    public function addRoute(string $method, string $uri, $handler): Route
    {
        $route = new Route($method, $uri, $handler);
        $this->routes[$method][$uri] = $route;
        return $route;
    }

    public function get(string $uri, $handler): Route
    {
        return $this->addRoute('GET', $uri, $handler);
    }

    public function post(string $uri, $handler): Route
    {
        return $this->addRoute('POST', $uri, $handler);
    }

    // Add other HTTP methods as needed

    public function dispatch(Request $request): Response
    {
        $method = $request->getMethod();
        $uri = $request->getUri()->getPath();

        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];
            return $this->executeHandler($route->getHandler(), $request);
        }

        throw new Exception('Route not found', 404);
    }

    protected function executeHandler($handler, Request $request): Response
    {
        if (is_callable($handler)) {
            $response = call_user_func($handler, $request);
        } elseif (is_array($handler) && count($handler) === 2) {
            [$controller, $method] = $handler;
            $response = call_user_func([new $controller, $method], $request);
        } else {
            throw new Exception('Invalid route handler');
        }

        if (!$response instanceof Response) {
            $response = new Response($response);
        }

        return $response;
    }
}
