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
