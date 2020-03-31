<?php

declare(strict_types=1);

namespace App\Cache;

use Psr\Cache\CacheItemPoolInterface;

class MemcachedCacheRepository implements CacheItemPoolInterface
{
    /**
     * @param string $cacheKey
     */
    public function getItem(string $cacheKey)
    {
        // TODO: Implement getItem() method.
    }
}
