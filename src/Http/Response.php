<?php

namespace phpStack\Http;

class Response
{
class Response
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
}

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

    // Implement ResponseInterface methods

    public function send(): void
    {
        // Send the response to the client
        // Set headers, output body, etc.
    }

    // Implement other methods from ResponseInterface
}
