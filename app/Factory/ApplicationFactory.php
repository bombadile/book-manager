<?php

declare(strict_types=1);

namespace App\Factory;

use App\Application;
use App\Middleware\MiddlewareResolver;
use Psr\Container\ContainerInterface;

class ApplicationFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Application
     */
    public function __invoke(ContainerInterface $container): Application
    {
        return new Application(
            $container->get(MiddlewareResolver::class),
        );
    }
}
