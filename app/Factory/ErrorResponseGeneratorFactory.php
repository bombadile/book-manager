<?php

declare(strict_types=1);

namespace App\Factory;

use App\Middleware\ErrorHandler\ErrorResponseGenerator;
use App\Middleware\ErrorHandler\ErrorJsonResponseBuilder;
use Psr\Container\ContainerInterface;

class ErrorResponseGeneratorFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Middleware\ErrorHandler\ErrorResponseGenerator
     */
    public function __invoke(ContainerInterface $container): ErrorResponseGenerator
    {
        return new ErrorResponseGenerator((new ErrorJsonResponseBuilder())->build('internal server error', 500));
    }
}
