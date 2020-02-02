<?php

declare(strict_types=1);

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Symfony\Component\Cache\Adapter\ApcuAdapter;
use Symfony\Component\Cache\Psr16Cache;

class CacheInterfaceFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \Symfony\Component\Cache\Psr16Cache
     */
    public function __invoke(ContainerInterface $container): Psr16Cache
    {
        return new Psr16Cache(new ApcuAdapter());
    }
}
