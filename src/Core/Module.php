<?php

namespace phpStack\Core;

abstract class Module
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    abstract public function register(): void;

    public function boot(): void
    {
        // This method can be overridden by child classes if needed
    }

    abstract public function getProviders(): array;
}
