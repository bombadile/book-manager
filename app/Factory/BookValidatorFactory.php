<?php

declare(strict_types=1);

namespace App\Factory;

use App\Repository\BookRepository;
use App\Validator\BookValidator;
use Psr\Container\ContainerInterface;

class BookValidatorFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Validator\BookValidator
     */
    public function __invoke(ContainerInterface $container): BookValidator
    {
        return new BookValidator($container->get(BookRepository::class));
    }
}
