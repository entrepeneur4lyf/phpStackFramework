# Cache Tag Cleanup System

## Overview

The tag cleanup system will periodically scan for and remove tags that no longer have any associated cache items. This helps prevent the accumulation of "orphaned" tags, which can bloat the Redis database and potentially slow down tag-based operations.

## Implementation

### 1. Update RedisTaggedCache

First, let's modify our `RedisTaggedCache` class to keep track of when tags are last used:

File: `src/Cache/RedisTaggedCache.php`

```php
<?php

namespace YourFramework\Cache;

use Redis;

class RedisTaggedCache implements TaggedCache
{
    // ... existing properties and methods ...

    private function tagKey(string $tag): string
    {
        return 'tag:' . $tag;
    }

    private function tagLastUsedKey(string $tag): string
    {
        return 'tag_last_used:' . $tag;
    }

    public function put(string $key, $value, $ttl = null): bool
    {
        $taggedKey = $this->taggedKey($key);
        $serialized = serialize($value);

        $this->redis->multi();
        foreach ($this->tags as $tag) {
            $this->redis->sAdd($this->tagKey($tag), $taggedKey);
            $this->redis->set($this->tagLastUsedKey($tag), time());
        }
        
        if ($ttl === null) {
            $this->redis->set($taggedKey, $serialized);
        } else {
            $this->redis->setex($taggedKey, $ttl, $serialized);
        }
        
        $result = $this->redis->exec();
        return !in_array(false, $result, true);
    }

    public function forget(string $key): bool
    {
        $taggedKey = $this->taggedKey($key);
        $this->redis->multi();
        $this->redis->del($taggedKey);
        foreach ($this->tags as $tag) {
            $this->redis->sRem($this->tagKey($tag), $taggedKey);
            $this->redis->set($this->tagLastUsedKey($tag), time());
        }
        $result = $this->redis->exec();
        return !in_array(false, $result, true);
    }

    // ... other methods remain the same
}
```

### 2. Create TagCleanupManager

Now, let's create a `TagCleanupManager` to handle the cleanup process:

File: `src/Cache/TagCleanupManager.php`

```php
<?php

namespace YourFramework\Cache;

use Redis;

class TagCleanupManager
{
    private Redis $redis;
    private int $maxTagAge;

    public function __construct(Redis $redis, int $maxTagAge = 604800) // Default to 1 week
    {
        $this->redis = $redis;
        $this->maxTagAge = $maxTagAge;
    }

    public function cleanup(): int
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
        } while ($cursor != 0);

        return $cleanedCount;
    }

    private function shouldCleanupTag(string $tag): bool
    {
        $lastUsedKey = 'tag_last_used:' . $tag;
        $lastUsed = $this->redis->get($lastUsedKey);

        if ($lastUsed === false) {
            // If last used time doesn't exist, check if the tag has any members
            return $this->redis->sCard('tag:' . $tag) == 0;
        }

        $timeSinceLastUsed = time() - intval($lastUsed);
        return $timeSinceLastUsed > $this->maxTagAge && $this->redis->sCard('tag:' . $tag) == 0;
    }

    private function cleanupTag(string $tag): void
    {
        $this->redis->multi();
        $this->redis->del('tag:' . $tag);
        $this->redis->del('tag_last_used:' . $tag);
        $this->redis->exec();
    }
}
```

### 3. Create a Command for Tag Cleanup

To run the cleanup process, let's create a command that can be scheduled or run manually:

File: `src/Console/Commands/CacheTagCleanup.php`

```php
<?php

namespace YourFramework\Console\Commands;

use YourFramework\Cache\TagCleanupManager;

class CacheTagCleanup
{
    private TagCleanupManager $cleanupManager;

    public function __construct(TagCleanupManager $cleanupManager)
    {
        $this->cleanupManager = $cleanupManager;
    }

    public function handle(): void
    {
        $cleanedCount = $this->cleanupManager->cleanup();
        echo "Cleaned up {$cleanedCount} orphaned cache tags.\n";
    }
}
```

### 4. Schedule the Cleanup Task

You can schedule this task to run periodically. If your framework doesn't have a task scheduler, you can create a simple one or use cron jobs. Here's a basic example of how you might schedule it:

File: `src/Console/Kernel.php`

```php
<?php

namespace YourFramework\Console;

use YourFramework\Console\Commands\CacheTagCleanup;

class Kernel
{
    protected $schedules = [
        'daily' => [
            CacheTagCleanup::class,
        ],
    ];

    public function schedule(): void
    {
        // Run daily tasks
        if (date('H:i') === '00:00') {
            foreach ($this->schedules['daily'] as $command) {
                $this->runCommand($command);
            }
        }
    }

    private function runCommand(string $commandClass): void
    {
        $command = $this->container->make($commandClass);
        $command->handle();
    }
}
```

### 5. Usage

To use this cleanup system, you would:

1. Ensure that your Redis connection is properly configured and accessible.
2. Set up the `TagCleanupManager` in your dependency injection container.
3. Schedule the `CacheTagCleanup` command to run at your desired interval.

Here's an example of how you might set this up in your application's bootstrap process:

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

This implementation provides several benefits:

1. **Efficiency**: It prevents the accumulation of unused tags, keeping your Redis database lean.
2. **Flexibility**: The max age for tags is configurable, allowing you to adjust based on your application's needs.
3. **Performance**: The cleanup process uses Redis's SCAN command, which is designed to be used in production without impacting performance.
4. **Scalability**: This approach works well even with large numbers of tags, as it processes them in small batches.

Potential next steps:

1. Implement logging for the cleanup process to track its effectiveness over time.
2. Add metrics collection to monitor the number of orphaned tags and cleanup efficiency.
3. Create a real-time monitoring system to alert if the number of orphaned tags exceeds a certain threshold.
4. Implement a manual cleanup trigger through an admin interface for on-demand cleanup.

