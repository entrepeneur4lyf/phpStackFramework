<?php

namespace phpStack\Http;

interface MiddlewareInterface
{
    public function process(Request $request, callable $next): Response;
}