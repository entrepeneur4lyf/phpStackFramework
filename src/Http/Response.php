<?php

namespace phpStack\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response implements ResponseInterface
{
    public int $statusCode;
    public array $headers = [];

    public function sendHeaders(): void
    {
        // Implementation
    }

    public function sendContent(): void
    {
        // Implementation
    }

    // Implement ResponseInterface methods

    public function send(): void
    {
        // Send the response to the client
        // Set headers, output body, etc.
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

    public function getStatusCode()
    {
        // Implement method
    }

    public function withStatus($code, $reasonPhrase = '')
    {
        // Implement method
    }

    public function getReasonPhrase()
    {
        // Implement method
    }
}
