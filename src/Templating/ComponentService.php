<?php

namespace phpStack\Templating;

abstract class ComponentService
{
    protected $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    abstract public function render(): string;

    public function getData(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public function setData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }
}