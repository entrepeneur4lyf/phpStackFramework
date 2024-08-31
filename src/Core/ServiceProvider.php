<?php

namespace phpStack\Core;

abstract class ServiceProvider
{
    protected $container;

    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    abstract public function register();

    public function boot()
    {
    }
}
