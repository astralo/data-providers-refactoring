<?php

declare(strict_types=1);

namespace App\Responses\Formatters;

class ResponseFormatter
{
    /**
     * @param string $format
     *
     * @return ResponseFormatterInterface
     */
    public static function getInstance(string $format): ResponseFormatterInterface
    {
        $config = config();
        if (in_array($format, $config['allowedResponseFormates']) && $config['defaultResponseFormat'] !== $format) {
            return new $config['allowedResponseFormates'][$format];
        }
        return new $config['allowedResponseFormates'][$config['defaultResponseFormat']];
    }
}
