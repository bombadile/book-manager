<?php

declare(strict_types=1);

namespace App\Factory;

use App\Repository\UserRepository;
use App\Validator\BookValidator;
use App\Repository\BookRepository;
use App\Service\BookService;
use Psr\Container\ContainerInterface;

class BookServiceFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Service\BookService
     */
    public function __invoke(ContainerInterface $container): BookService
    {
        return new BookService(
            $container->get(BookValidator::class),
            $container->get(BookRepository::class),
        );
    }
}
