<?php

declare(strict_types=1);

namespace App\Factory;

use App\Middleware\ErrorHandler\WhoopsErrorResponseGenerator;
use Psr\Container\ContainerInterface;
use Whoops\RunInterface;
use Laminas\Diactoros\Response;

class WhoopsErrorResponseGeneratorFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Middleware\ErrorHandler\WhoopsErrorResponseGenerator
     */
    public function __invoke(ContainerInterface $container): WhoopsErrorResponseGenerator
    {
        return new WhoopsErrorResponseGenerator(
            $container->get(RunInterface::class),
            new Response()
        );
    }
}
