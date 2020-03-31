<?php

declare(strict_types=1);

namespace App\Responses\Formatters;

class JsonResponseFormatter extends ResponseFormatter implements ResponseFormatterInterface
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function format(array $data): string
    {
        return json_encode($data);
    }
}
