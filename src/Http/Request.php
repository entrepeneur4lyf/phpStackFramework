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

    public function getProtocolVersion()
    {
        // Implement method
    }

    public function withProtocolVersion($version)
    {
        // Implement method
    }

    public function getHeaders()
    {
        // Implement method
    }

    public function hasHeader($name)
    {
        // Implement method
    }

    public function getHeader($name)
    {
        // Implement method
    }

    public function getHeaderLine($name)
    {
        // Implement method
    }

    public function withHeader($name, $value)
    {
        // Implement method
    }

    public function withAddedHeader($name, $value)
    {
        // Implement method
    }

    public function withoutHeader($name)
    {
        // Implement method
    }

    public function getBody()
    {
        // Implement method
    }

    public function withBody(StreamInterface $body)
    {
        // Implement method
    }

    public function getRequestTarget()
    {
        // Implement method
    }

    public function withRequestTarget($requestTarget)
    {
        // Implement method
    }

    public function withMethod($method)
    {
        // Implement method
    }

    public function getServerParams()
    {
        // Implement method
    }

    public function getCookieParams()
    {
        // Implement method
    }

    public function withCookieParams(array $cookies)
    {
        // Implement method
    }

    public function getQueryParams()
    {
        // Implement method
    }

    public function withQueryParams(array $query)
    {
        // Implement method
    }

    public function getUploadedFiles()
    {
        // Implement method
    }

    public function withUploadedFiles(array $uploadedFiles)
    {
        // Implement method
    }

    public function getParsedBody()
    {
        // Implement method
    }

    public function withParsedBody($data)
    {
        // Implement method
    }

    public function getAttributes()
    {
        // Implement method
    }

    public function getAttribute($name, $default = null)
    {
        // Implement method
    }

    public function withAttribute($name, $value)
    {
        // Implement method
    }

    public function withoutAttribute($name)
    {
        // Implement method
    }
}
