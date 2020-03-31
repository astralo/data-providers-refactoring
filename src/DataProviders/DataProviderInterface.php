<?php

declare(strict_types=1);

namespace App\DataProviders;

interface DataProviderInterface
{
    public function get(array $params): array;
}
