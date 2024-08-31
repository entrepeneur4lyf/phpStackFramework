<?php

namespace phpStack\Core\Cache;

class CacheManager
{
    /** @var array<string, mixed> */
    protected array $cache = [];

    public function has(string $key): bool
    {
        return isset($this->cache[$key]);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->cache[$key] ?? $default;
    }

    public function set(string $key, mixed $value): void
    {
        $this->cache[$key] = $value;
    }

    public function forget(string $key): void
    {
        unset($this->cache[$key]);
    }
}
