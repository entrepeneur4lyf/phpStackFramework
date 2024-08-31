<?php

namespace phpStack\Http;

class MiddlewarePipeline
{
    protected $middlewares = [];

    public function pipe(MiddlewareInterface $middleware): self
    {
        $this->middlewares[] = $middleware;
        return $this;
    }

    public function process(Request $request, callable $handler): Response
    {
        return $this->passToMiddleware($request, 0, $handler);
    }

    protected function passToMiddleware(Request $request, int $index, callable $handler): Response
    {
        if ($index >= count($this->middlewares)) {
            return $handler($request);
        }

        $middleware = $this->middlewares[$index];

        return $middleware->process($request, function ($request) use ($index, $handler) {
            return $this->passToMiddleware($request, $index + 1, $handler);
        });
    }
}

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MiddlewarePipeline implements RequestHandlerInterface
{
    protected array $middleware = [];

    public function add(MiddlewareInterface $middleware): self
    {
        $this->middleware[] = $middleware;
        return $this;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $this->handle($request);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (empty($this->middleware)) {
            throw new \RuntimeException('No middleware in the pipeline');
        }

        $middleware = array_shift($this->middleware);
        return $middleware->process($request, $this);
    }
}
