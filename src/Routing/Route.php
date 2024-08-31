<?php

namespace phpStack\Routing;

class Route
{
    protected string $method;
    protected string $uri;
    protected $handler;

    public function __construct(string $method, string $uri, $handler)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->handler = $handler;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHandler()
    {
        return $this->handler;
    }
}

class Route
{
    protected string $method;
    protected string $uri;
    protected $handler;

    public function __construct(string $method, string $uri, $handler)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->handler = $handler;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHandler()
    {
        return $this->handler;
    }
}
