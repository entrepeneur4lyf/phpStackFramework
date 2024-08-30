<?php

namespace phpStack\Core;

abstract class Module
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    abstract public function register(): void;

    public function boot(): void
    {
        // This method can be overridden by child classes if needed
    }

    abstract public function getNamespace(): string;

    abstract public function getPath(): string;
}