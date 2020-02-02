<?php

declare(strict_types=1);

namespace App\Middleware\ErrorHandler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ErrorHandlerMiddleware implements MiddlewareInterface
{
    /**
     * @var callable[]
     */
    private array $listeners = [];
    private ErrorResponseGeneratorInterface $responseGenerator;

    /**
     * @param \App\Middleware\ErrorHandler\ErrorResponseGeneratorInterface $responseGenerator
     */
    public function __construct(ErrorResponseGeneratorInterface $responseGenerator)
    {
        $this->responseGenerator = $responseGenerator;
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Server\RequestHandlerInterface $handler
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (\Throwable $e) {
            foreach ($this->listeners as $listener) {
                $listener($e, $request);
            }
            return $this->responseGenerator->generate($e, $request);
        }
    }

    /**
     * @param callable $listener
     */
    public function addListener(callable $listener): void
    {
        $this->listeners[] = $listener;
    }
}
