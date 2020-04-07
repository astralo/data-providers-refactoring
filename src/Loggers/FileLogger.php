<?php

declare(strict_types=1);

namespace App\Loggers;

use Psr\Log\LoggerInterface;

class FileLogger implements LoggerInterface
{
    /**
     * @param string $message
     */
    public function critical(string $message): void
    {
        // TODO: Implement critical() method.
    }
}
