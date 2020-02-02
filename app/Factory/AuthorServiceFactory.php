<?php

declare(strict_types=1);

namespace App\Factory;

use App\Repository\UserRepository;
use App\Validator\AuthorValidator;
use App\Repository\AuthorRepository;
use App\Service\AuthorService;
use Psr\Container\ContainerInterface;

class AuthorServiceFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Service\AuthorService
     */
    public function __invoke(ContainerInterface $container): AuthorService
    {
        return new AuthorService(
            $container->get(AuthorValidator::class),
            $container->get(AuthorRepository::class),
        );
    }
}
