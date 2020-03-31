<?php

declare(strict_types=1);

namespace App\Loggers;

use Psr\Log\LoggerInterface;

class Logger
{
    /**
     * @return LoggerInterface
     */
    public static function getInstance(): LoggerInterface
    {
        if (config()['production']) {
            return new KibanaLogger();
        }
        return new FileLogger();
    }
}
