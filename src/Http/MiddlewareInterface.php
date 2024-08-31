<?php

namespace phpStack\Http;

interface MiddlewareInterface
{
    public function process(Request $request, callable $next): Response;
}

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface as PsrMiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

interface MiddlewareInterface extends PsrMiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface;
}
