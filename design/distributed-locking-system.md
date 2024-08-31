# Distributed Locking System for Cache Tag Cleanup

## Overview

We'll implement a distributed locking mechanism using Redis to ensure that only one instance of the application can run the cache tag cleanup process at a time. This is crucial in clustered environments to prevent race conditions and duplicate work.

## Implementation

### 1. Create a Distributed Lock Class

First, let's create a `DistributedLock` class that will handle acquiring and releasing locks:

File: `src/Cache/DistributedLock.php`

```php
<?php

namespace YourFramework\Cache;

use Redis;
use Exception;

class DistributedLock
{
    private Redis $redis;
    private string $lockKey;
    private string $lockValue;
    private int $ttl;

    public function __construct(Redis $redis, string $lockKey, int $ttl = 60)
    {
        $this->redis = $redis;
        $this->lockKey = "lock:{$lockKey}";
        $this->lockValue = uniqid('', true);
        $this->ttl = $ttl;
    }

    public function acquire(): bool
    {
        return $this->redis->set($this->lockKey, $this->lockValue, ['NX', 'EX' => $this->ttl]);
    }

    public function release(): bool
    {
        $script = <<<LUA
        if redis.call("get", KEYS[1]) == ARGV[1] then
            return redis.call("del", KEYS[1])
        else
            return 0
        end
        LUA;

        return (bool) $this->redis->eval($script, [$this->lockKey, $this->lockValue], 1);
    }

    public function extend(int $ttl = null): bool
    {
        $ttl = $ttl ?? $this->ttl;
        
        $script = <<<LUA
        if redis.call("get", KEYS[1]) == ARGV[1] then
            return redis.call("expire", KEYS[1], ARGV[2])
        else
            return 0
        end
        LUA;

        return (bool) $this->redis->eval($script, [$this->lockKey, $this->lockValue, $ttl], 1);
    }
}
```

### 2. Update TagCleanupManager

Now, let's modify our `TagCleanupManager` to use the distributed lock:

File: `src/Cache/TagCleanupManager.php`

```php
<?php

namespace YourFramework\Cache;

use Redis;
use Exception;

class TagCleanupManager
{
    private Redis $redis;
    private int $maxTagAge;
    private DistributedLock $lock;

    public function __construct(Redis $redis, int $maxTagAge = 604800) // Default to 1 week
    {
        $this->redis = $redis;
        $this->maxTagAge = $maxTagAge;
        $this->lock = new DistributedLock($redis, 'cache_tag_cleanup', 3600); // 1 hour lock
    }

    public function cleanup(): int
    {
        if (!$this->lock->acquire()) {
            throw new Exception("Unable to acquire lock for cache tag cleanup.");
        }

        try {
            $cleanedCount = $this->performCleanup();
            $this->lock->release();
            return $cleanedCount;
        } catch (Exception $e) {
            $this->lock->release();
            throw $e;
        }
    }

    private function performCleanup(): int
    {
        $cleanedCount = 0;
        $cursor = 0;
        $pattern = 'tag:*';

        do {
            [$cursor, $keys] = $this->redis->scan($cursor, $pattern, 100);

            foreach ($keys as $tagKey) {
                $tag = substr($tagKey, 4); // Remove 'tag:' prefix
                if ($this->shouldCleanupTag($tag)) {
                    $this->cleanupTag($tag);
                    $cleanedCount++;
                }
            }

            // Extend the lock periodically to prevent it from expiring during long cleanup processes
            if ($cleanedCount % 1000 === 0) {
                $this->lock->extend();
            }

        } while ($cursor != 0);

        return $cleanedCount;
    }

    // ... rest of the methods remain the same
}
```

### 3. Update the CacheTagCleanup Command

Let's modify our `CacheTagCleanup` command to handle potential locking exceptions:

File: `src/Console/Commands/CacheTagCleanup.php`

```php
<?php

namespace YourFramework\Console\Commands;

use YourFramework\Cache\TagCleanupManager;
use Exception;

class CacheTagCleanup
{
    private TagCleanupManager $cleanupManager;

    public function __construct(TagCleanupManager $cleanupManager)
    {
        $this->cleanupManager = $cleanupManager;
    }

    public function handle(): void
    {
        try {
            $cleanedCount = $this->cleanupManager->cleanup();
            echo "Cleaned up {$cleanedCount} orphaned cache tags.\n";
        } catch (Exception $e) {
            echo "Error during cache tag cleanup: " . $e->getMessage() . "\n";
        }
    }
}
```

### 4. Usage

The usage remains the same as before, but now with the added benefit of distributed locking. Here's a reminder of how to set it up:

```php
<?php

use YourFramework\Cache\TagCleanupManager;
use YourFramework\Console\Commands\CacheTagCleanup;

// In your application's service provider or bootstrap file
$container->singleton(TagCleanupManager::class, function ($container) {
    $redis = $container->make(Redis::class);
    return new TagCleanupManager($redis, 604800); // 1 week max age
});

$container->singleton(CacheTagCleanup::class, function ($container) {
    return new CacheTagCleanup($container->make(TagCleanupManager::class));
});

// Set up the console kernel and run scheduled tasks
$kernel = $container->make(Kernel::class);
$kernel->schedule();
```

## Benefits of this Implementation

1. **Race Condition Prevention**: Only one instance of the application can run the cleanup process at a time, preventing potential conflicts in clustered environments.

2. **Fault Tolerance**: If the cleanup process crashes or the application instance goes down, the lock will automatically expire after the TTL, allowing another instance to take over.

3. **Long-running Process Support**: The lock is periodically extended during the cleanup process, allowing for very large cleanups without losing the lock.

4. **Atomicity**: The lock acquisition and release operations are atomic, thanks to Redis's support for Lua scripting.

5. **Flexibility**: The lock TTL is configurable, allowing you to adjust based on your expected cleanup duration.

## Potential Enhancements

1. **Retry Mechanism**: Implement a retry mechanism with exponential backoff for lock acquisition in case of high contention.

2. **Lock Queue**: Create a queue system where instances can wait for the lock instead of immediately failing if it's not available.

3. **Monitoring**: Add monitoring and alerting for lock acquisition failures or unusually long lock hold times.

4. **Dynamic TTL**: Implement a system to dynamically adjust the lock TTL based on historical cleanup durations.

5. **Graceful Shutdown**: Ensure that the lock is released properly during application shutdown scenarios.

This distributed locking system ensures that your cache tag cleanup process runs safely and efficiently in clustered environments, preventing potential data inconsistencies and wasted resources from duplicate cleanup attempts.
