<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DataProviders\DataProviderService;
use App\Exceptions\BusinessException;
use App\Loggers\Logger;
use App\Responses\Formatters\ResponseFormatter;

class LessonsController
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    public $logger;

    /**
     * @var DataProviderService
     */
    public $dataProviderService;

    public function __construct(
        DataProviderService $dataProviderService
    )
    {
        // it's necessary to inject with DI through IoC container
        $this->logger = Logger::getInstance();
        $this->dataProviderService = $dataProviderService;
    }

    /**
     * @param int $cat
     * @param string $responseFormat
     *
     * @return string
     */
    public function action($cat, string $responseFormat = 'json')
    {
        try {
            if (!$this->validateCategory($cat)) {
                throw new BusinessException('Undefined category ID');
            }

            $data = $this->dataProviderService->getResponse([
                "categoryId" => $cat
            ]);

            $response = ResponseFormatter::getInstance($responseFormat);

            return $response->format($data);

        } catch (BusinessException $exception) {
            $this->logger->critical($exception->getMessage());
            return $exception->getUserMessage();

        } catch (\Throwable $exception) {
            $this->logger->critical($exception->getMessage());
            return 'error';
        }
    }

    /**
     * @param $cat
     *
     * @return bool
     */
    private function validateCategory($cat): bool
    {
        if (!preg_match('/[0-9]{5}/', $cat)) {
            return false;
        }
        return $cat > 0;
    }
}
