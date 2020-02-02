<?php

declare(strict_types=1);

namespace App\Factory;

use GraphQL\Type\Schema;
use Psr\Container\ContainerInterface;
use Psr\SimpleCache\CacheInterface;
use TheCodingMachine\GraphQLite\SchemaFactory as SchemaGraphQLFactory;

class SchemaFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \TheCodingMachine\GraphQLite\Schema
     */
    public function __invoke(ContainerInterface $container): Schema
    {
        $factory = new SchemaGraphQLFactory($container->get(CacheInterface::class), $container);
        $factory->addControllerNamespace('App\\Controller\\');
        $factory->addTypeNamespace('App\\');
        return $factory->createSchema();
    }
}
