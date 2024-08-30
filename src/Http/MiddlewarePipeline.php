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