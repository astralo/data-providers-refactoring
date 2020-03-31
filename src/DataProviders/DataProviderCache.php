<?php

declare(strict_types=1);

namespace App\DataProviders;

class DataProviderCache
{
    public const CACHE_SUFFIX = 'lessons';

    /**
     * @param string $input
     *
     * @return string
     */
    public static function getKey(string $input = ''): string
    {
        return self::CACHE_SUFFIX . $input;
    }
}
