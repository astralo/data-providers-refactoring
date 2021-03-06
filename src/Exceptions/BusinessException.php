<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

class BusinessException extends \RuntimeException
{
    private string $userMessage;

    public function __construct(string $message, array $params)
    {
        $this->userMessage = $message;
        parent::__construct('Business exception');
    }

    /**
     * @return string
     */
    public function getUserMessage(): string
    {
        return $this->userMessage;
    }
}
