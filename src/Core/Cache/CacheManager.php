<?php

namespace phpStack\Core\Cache;

class CacheManager
{
    protected $cache = [];

    public function has($key)
    {
        return isset($this->cache[$key]);
    }

    public function get($key, $default = null)
    {
        return $this->cache[$key] ?? $default;
    }

    public function set($key, $value)
    {
        $this->cache[$key] = $value;
    }

    public function forget($key)
    {
        unset($this->cache[$key]);
    }
}
