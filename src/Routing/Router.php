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
        // Implement method
        return true;
    }

    protected function isParameter(string $segment): bool
    {
        // Implement method
        return true;
    }

    protected function executeHandler($handler, Request $request): Response
    {
        // Implement method
        return new Response();
    }
}

use phpStack\Http\Request as HttpRequest;
use phpStack\Http\Response as HttpResponse;
use Exception;

