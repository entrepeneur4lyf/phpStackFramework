<?php

namespace PhpStack\Core;

class Config
{
    protected array $config = [];

    public function load(string $path): void
    {
        if (!file_exists($path)) {
            throw new \RuntimeException("Configuration file not found: $path");
        }

        $config = require $path;
        if (!is_array($config)) {
            throw new \RuntimeException("Invalid configuration file: $path");
        }

        $this->config = array_merge($this->config, $config);
    }

    public function get(string $key, $default = null)
    {
        return $this->config[$key] ?? $default;
    }

    public function set(string $key, $value): void
    {
        $this->config[$key] = $value;
    }

    public function has(string $key): bool
    {
        return isset($this->config[$key]);
    }
}
