<?php

declare(strict_types=1);

namespace App\DataProviders\DataProviderDecorators;

use App\DataProviders\{
    DataProvider,
    DataProviderCache,
    DataProviderInterface
};
use DateTimeInterface;
use Psr\Cache\CacheItemPoolInterface;

class CacheDataProviderDecorator implements DataProviderInterface
{
    public const TTL = '+1 day';

    /**
     * @var DataProvider
     */
    private $dataProvider;

    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    public function __construct(
        DataProvider $dataProvider,
        CacheItemPoolInterface $cache
    )
    {
        $this->dataProvider = $dataProvider;
        $this->cache = $cache;
    }

    /**
     * @param array $params
     *
     * @return array
     * @throws \Exception
     */
    public function get(array $params): array
    {
        $cacheKey = DataProviderCache::getKey(json_encode($params));

        $cacheItem = $this->cache->getItem($cacheKey);

        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        $result = $this->dataProvider->get($params);

        $cacheItem
            ->set($result)
            ->expiresAt($this->getExpiryDate());

        return $result;
    }

    /**
     * @return DateTimeInterface
     * @throws \Exception
     */
    private function getExpiryDate(): DateTimeInterface
    {
        return (new \DateTime())->modify(self::TTL);
    }
}
