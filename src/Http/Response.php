<?php

namespace phpStack\Http;

class Response
{
    protected $content;
    protected $statusCode;
    protected $headers;

    public function __construct(string $content = '', int $statusCode = 200, array $headers = [])
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function addHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function send(): void
    {
        $this->sendHeaders();
        $this->sendContent();
    }

    protected function sendHeaders(): void
    {
        http_response_code($this->statusCode);
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
    }

    protected function sendContent(): void
    {
        echo $this->content;
    }
}<?php

namespace PhpStack\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response implements ResponseInterface
{
    // Implement ResponseInterface methods

    public function send(): void
    {
        // Send the response to the client
        // Set headers, output body, etc.
    }

    // Implement other methods from ResponseInterface
}
