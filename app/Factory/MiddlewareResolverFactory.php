<?php

declare(strict_types=1);

namespace App\Factory;

use App\Middleware\MiddlewareResolver;
use Psr\Container\ContainerInterface;
use Laminas\Diactoros\Response;

class MiddlewareResolverFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Middleware\MiddlewareResolver
     */
    public function __invoke(ContainerInterface $container): MiddlewareResolver
    {
        return new MiddlewareResolver($container, new Response());
    }
}
