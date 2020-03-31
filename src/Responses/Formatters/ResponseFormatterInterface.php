<?php

declare(strict_types=1);

namespace App\Responses\Formatters;

interface ResponseFormatterInterface
{
    public function format(array $data): string;
}
