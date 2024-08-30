<?php

namespace phpStack\Routing;

use phpStack\Http\Request;
use phpStack\Http\Response;

class Router
{
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