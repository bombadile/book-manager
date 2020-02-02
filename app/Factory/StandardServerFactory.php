<?php

declare(strict_types=1);

namespace App\Factory;

use GraphQL\Server\StandardServer;
use GraphQL\Type\Schema;
use Psr\Container\ContainerInterface;

class StandardServerFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \GraphQL\Server\StandardServer
     */
    public function __invoke(ContainerInterface $container): StandardServer
    {
        return new StandardServer([
            'schema' => $container->get(Schema::class)
        ]);
    }
}
