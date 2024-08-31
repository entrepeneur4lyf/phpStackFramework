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

    // Implement other methods from ResponseInterface
}
