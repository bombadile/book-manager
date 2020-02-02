<?php

declare(strict_types=1);

namespace App\Factory;

use App\Model\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Psr\Container\ContainerInterface;

class BookRepositoryFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Repository\BookRepository
     */
    public function __invoke(ContainerInterface $container): BookRepository
    {
        /**
         * @var EntityManagerInterface $em
         * @var EntityRepository $repository
         */
        $em = $container->get(EntityManagerInterface::class);
        $repository =  $em->getRepository(Book::class);

        return new BookRepository($em, $repository);
    }
}
