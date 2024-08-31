<?php

namespace phpStack\Http;

class Request
{
    protected $get;
    protected $post;
    protected $server;
    protected $files;
    protected $cookies;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->files = $_FILES;
        $this->cookies = $_COOKIE;
    }

    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getUri(): string
    {
        return $this->server['REQUEST_URI'];
    }

    public function getQueryParams(): array
    {
        return $this->get;
    }

    public function getPostData(): array
    {
        return $this->post;
    }

    public function getHeaders(): array
    {
        $headers = [];
        foreach ($this->server as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($key, 5)))))] = $value;
            }
        }
        return $headers;
    }

    public function getCookies(): array
    {
        return $this->cookies;
    }

    public function getFiles(): array
    {
        return $this->files;
    }
}

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

    // Implement ServerRequestInterface methods

    public static function createFromGlobals(): self
    {
        // Create a new Request instance from PHP globals
        // Implement the logic to populate the request from $_SERVER, $_GET, $_POST, etc.
        return new self();
    }

    public function getMethod(): string
    {
        // Implement method retrieval
    }

    public function getUri(): UriInterface
    {
        // Implement URI retrieval
    }

    // Implement other methods from ServerRequestInterface
}
