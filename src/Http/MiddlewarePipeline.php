<?php

namespace phpStack\Http;

class MiddlewarePipeline implements \Psr\Http\Server\RequestHandlerInterface
{
    protected array $middleware = [];

    public function add(\Psr\Http\Server\MiddlewareInterface $middleware): self
    {
        $this->middleware[] = $middleware;
        return $this;
    }

    public function process(\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Server\RequestHandlerInterface $handler): \Psr\Http\Message\ResponseInterface
    {
        return $this->handle($request);
    }

    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        if (empty($this->middleware)) {
            throw new \RuntimeException('No middleware in the pipeline');
        }

        $middleware = array_shift($this->middleware);
        return $middleware->process($request, $this);
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
