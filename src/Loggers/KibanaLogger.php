<?php

declare(strict_types=1);

namespace App\Loggers;

use Psr\Log\LoggerInterface;

class KibanaLogger implements LoggerInterface
{
    /**
     * @param string $message
     */
    public function critical(string $message)
    {
        // TODO: Implement critical() method.
    }
}
