<?php

declare(strict_types=1);

namespace App\Factory;

use App\Middleware\ErrorHandler\ErrorHandlerMiddleware;
use App\Middleware\ErrorHandler\ErrorResponseGeneratorInterface;
use App\Middleware\ErrorHandler\LogErrorListener;
use Psr\Container\ContainerInterface;

class ErrorHandlerMiddlewareFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Middleware\ErrorHandler\ErrorHandlerMiddleware
     */
    public function __invoke(ContainerInterface $container): ErrorHandlerMiddleware
    {
        $middleware =  new ErrorHandlerMiddleware(
            $container->get(ErrorResponseGeneratorInterface::class)
        );
        $middleware->addListener($container->get(LogErrorListener::class));
        return $middleware;
    }
}
