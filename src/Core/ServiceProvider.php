<?php

namespace phpStack\Core;

abstract class ServiceProvider
{
    protected Container $container;

    public function setContainer(Container $container): void
    {
        $this->container = $container;
    }

    abstract public function register(): void;

    public function boot(): void
    {
    }
}

abstract class ServiceProvider
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
}
