<?php

declare(strict_types=1);

namespace App\Factory;

use App\Model\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Psr\Container\ContainerInterface;

class AuthorRepositoryFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Repository\AuthorRepository
     */
    public function __invoke(ContainerInterface $container): AuthorRepository
    {
        /**
         * @var EntityManagerInterface $em
         * @var EntityRepository $repository
         */
        $em = $container->get(EntityManagerInterface::class);
        $repository =  $em->getRepository(Author::class);

        return new AuthorRepository($em, $repository);
    }
}
