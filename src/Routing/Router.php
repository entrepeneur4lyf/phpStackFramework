<?php

namespace phpStack\Routing;

use phpStack\Http\Request;
use phpStack\Http\Response;

    protected $routes = [];

    public function addRoute(string $method, string $path, $handler): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
        ];
    }

    public function get(string $path, $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    public function match(Request $request): ?array
    {
        $method = $request->getMethod();
        $path = $request->getUri();

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $this->pathMatches($route['path'], $path)) {
                return $route;
            }
        }

        return null;
    }

    protected function pathMatches(string $routePath, string $requestPath): bool
    {
        $routeSegments = explode('/', trim($routePath, '/'));
        $requestSegments = explode('/', trim($requestPath, '/'));

        if (count($routeSegments) !== count($requestSegments)) {
            return false;
        }

        foreach ($routeSegments as $index => $segment) {
            if ($segment !== $requestSegments[$index] && !$this->isParameter($segment)) {
                return false;
            }
        }

        return true;
    }

    protected function isParameter(string $segment): bool
    {
        return preg_match('/^{.+}$/', $segment) === 1;
    }

    public function dispatch(Request $request): Response
    {
        $route = $this->match($request);

        if ($route === null) {
            return new Response('404 Not Found', 404);
        }

        $handler = $route['handler'];

        if (is_callable($handler)) {
            return $handler($request);
        }

        if (is_array($handler) && count($handler) === 2) {
            [$controller, $method] = $handler;
            $controllerInstance = new $controller();
            return $controllerInstance->$method($request);
        }

        throw new \RuntimeException('Invalid route handler');
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
