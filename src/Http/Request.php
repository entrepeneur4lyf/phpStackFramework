<?php

namespace phpStack\Http;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request implements ServerRequestInterface
{
    public string $method;
    public UriInterface $uri;
    public string $protocol;
    public array $attributes = [];
    public $body = null;

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    // Implement ServerRequestInterface methods

    public static function createFromGlobals(): self
    {
        // Create a new Request instance from PHP globals
        // Implement the logic to populate the request from $_SERVER, $_GET, $_POST, etc.
        return new self();
    }

    // Implement other methods from ServerRequestInterface
}
