<?php

declare(strict_types=1);

namespace App\Factory;

use GraphQL\Type\Schema;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\MiddlewareInterface;
use TheCodingMachine\GraphQLite\Http\Psr15GraphQLMiddlewareBuilder;

class WebonyxGraphqlMiddlewareFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \Psr\Http\Server\MiddlewareInterface
     */
    public function __invoke(ContainerInterface $container): MiddlewareInterface
    {
        $builder = new Psr15GraphQLMiddlewareBuilder($container->get(Schema::class));
        return $builder->createMiddleware();
    }
}
