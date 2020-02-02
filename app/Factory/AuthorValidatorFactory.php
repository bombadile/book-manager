<?php

declare(strict_types=1);

namespace App\Factory;

use App\Repository\AuthorRepository;
use App\Validator\AuthorValidator;
use Psr\Container\ContainerInterface;

class AuthorValidatorFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Validator\AuthorValidator
     */
    public function __invoke(ContainerInterface $container): AuthorValidator
    {
        return new AuthorValidator($container->get(AuthorRepository::class));
    }
}
