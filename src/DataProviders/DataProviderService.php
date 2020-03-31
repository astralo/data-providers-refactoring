<?php

declare(strict_types=1);

namespace App\DataProviders;

use App\Cache\MemcachedCacheRepository;
use App\DataProviders\DataProviderDecorators\CacheDataProviderDecorator;
use App\Loggers\Logger;
use Psr\Cache\CacheItemPoolInterface;

class DataProviderService
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    public function __construct()
    {
        $this->logger = Logger::getInstance();
        $this->config = config();
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
            return new CacheDataProviderDecorator($dataProvider, new MemcachedCacheRepository());
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

        $result = $dataProvider->get($params);

        return $result;
    }
}
