<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\AbstractModel;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

abstract class AbstractRepository implements RepositoryInterface
{
    protected EntityManagerInterface $manager;
    protected EntityRepository $repository;

    /**
     * @inheritDoc
     */
    abstract public function getModelName(): string;

    /**
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param \Doctrine\ORM\EntityRepository $repository
     */
    public function __construct(EntityManagerInterface $manager, EntityRepository $repository)
    {
        $this->manager = $manager;
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria, array $orderBy = null): ?object
    {
        return $this->repository->findOneBy($criteria, $orderBy);
    }

    /**
     * {@inheritdoc}
     */
    public function insert(AbstractModel $object): void
    {
        $this->manager->persist($object);
        $this->manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function edit(): void
    {
        $this->manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(AbstractModel $object): void
    {
        $this->manager->remove($object);
        $this->manager->flush();
    }

    /**
     * @param string $className
     * @return string
     */
    protected function getMetadataName(string $className): string
    {
        $meta = $this->manager->getClassMetadata($className);
        $nameWithNameSpace = explode("\\", $meta->getName());
        return end($nameWithNameSpace);
    }
}
