<?php

declare(strict_types=1);

namespace App\Factory;

use Psr\Container\ContainerInterface;

class PDOFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \PDO
     */
    public function __invoke(ContainerInterface $container): \PDO
    {
        $config = $container->get('config')['pdo'];

        return new \PDO(
            $config['dsn'],
            $config['username'],
            $config['password'],
            $config['options']
        );
    }
}
