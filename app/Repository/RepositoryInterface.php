<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\AbstractModel;

interface RepositoryInterface
{
    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @return null|AbstractModel
     */
    public function findOneBy(array $criteria, array $orderBy = null): ?object;

    /**
     * @param \App\Model\AbstractModel $object
     */
    public function insert(AbstractModel $object): void;

    public function edit(): void;

    /**
     * @param \App\Model\AbstractModel $object
     */
    public function delete(AbstractModel $object): void;

    /**
     * @return string
     */
    public function getModelName(): string;
}
