<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Author;

class AuthorRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return $this->getMetadataName(Author::class);
    }
}
