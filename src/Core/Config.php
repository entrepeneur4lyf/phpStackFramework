<?php

namespace phpStack\Core;

class Config
{
    protected $config = [];

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
        $keys = explode('.', $key);
        $value = $this->config;

        foreach ($keys as $subKey) {
            if (!isset($value[$subKey])) {
                return $default;
            }
            $value = $value[$subKey];
        }

        return $value;
    }

    public function set(string $key, $value): void
    {
        $keys = explode('.', $key);
        $config = &$this->config;

        foreach ($keys as $index => $subKey) {
            if ($index === count($keys) - 1) {
                $config[$subKey] = $value;
            } else {
                if (!isset($config[$subKey]) || !is_array($config[$subKey])) {
                    $config[$subKey] = [];
                }
                $config = &$config[$subKey];
            }
        }
    }
}