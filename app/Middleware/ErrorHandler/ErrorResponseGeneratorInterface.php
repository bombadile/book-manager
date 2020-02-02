<?php

declare(strict_types=1);

namespace App\Middleware\ErrorHandler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ErrorResponseGeneratorInterface
{
    /**
     * @param \Throwable $e
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function generate(\Throwable $e, ServerRequestInterface $request): ResponseInterface;
}
