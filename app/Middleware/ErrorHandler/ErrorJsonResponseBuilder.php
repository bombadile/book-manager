<?php

declare(strict_types=1);

namespace App\Middleware\ErrorHandler;

use Laminas\Diactoros\Response\JsonResponse;

class ErrorJsonResponseBuilder
{
    /**
     * @param $message
     * @param int $code
     * @return \Laminas\Diactoros\Response\JsonResponse
     */
    public function build(string $message, int $code): JsonResponse
    {
        return new JsonResponse(['errors' => [['message' => $message]]], $code);
    }
}
