<?php

declare(strict_types=1);

namespace App\DataProviders;

use App\Cache\MemcachedCacheRepository;
use App\DataProviders\DataProviderDecorators\CacheDataProviderDecorator;
use App\Loggers\Logger;
use Psr\Cache\CacheItemPoolInterface;

class DataProviderService
{
    private array $config;
    private \Psr\Log\LoggerInterface $logger;
    private MemcachedCacheRepository $memcachedCacheRepository;

    public function __construct(
        MemcachedCacheRepository $memcachedCacheRepository
    )
    {
        $this->logger = Logger::getInstance();
        $this->config = config();
        $this->memcachedCacheRepository = $memcachedCacheRepository;
    }

    /**
     * @return DataProviderInterface
     */
    private function getDataProvider(): DataProviderInterface
    {
        $dataProvider = new DataProvider(
            $this->config['host'],
            $this->config['user'],
            $this->config['password']
        );

        if ($this->config['production']) {
            return new CacheDataProviderDecorator($dataProvider, $this->memcachedCacheRepository);
        }
        return $dataProvider;
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function getResponse(array $params): array
    {
        $dataProvider = $this->getDataProvider();

        return $dataProvider->get($params);
    }
}
