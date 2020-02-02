<?php

declare(strict_types=1);

namespace App\Repository;

use App\Input\BookFilterInput;
use App\Input\BookSortInput;
use App\Model\Book;
use Doctrine\ORM\Query\Expr;

class BookRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return $this->getMetadataName(Book::class);
    }

    /**
     * @param \App\Input\BookFilterInput $filterInput
     * @param \App\Input\BookSortInput $sortInput
     * @return Book[]|null
     */
    public function findBy(BookFilterInput $filterInput, BookSortInput $sortInput): array
    {
        $builder = $this->repository->createQueryBuilder('b');
        $builder->select('b')
            ->setFirstResult($filterInput->getOffset())
            ->setMaxResults($filterInput->getLimit());

        if ($releaseDataStart = $filterInput->getReleaseDateStart()) {
            $builder->andWhere('b.releaseDate >= :release_date_start')->setParameter(
                'release_date_start',
                $releaseDataStart
            );
        }

        if ($releaseDataEnd = $filterInput->getReleaseDateEnd()) {
            $builder->andWhere('b.releaseDate <= :release_date_end')->setParameter('release_date_end', $releaseDataEnd);
        }

        if ($countAuthors = $filterInput->getCountAuthors()) {
            $builder->join('b.authors', 'a', Expr\Join::WITH);
            $builder->addGroupBy('b');
            $builder->having('COUNT (a.id) = :count_authors')->setParameter('count_authors', $countAuthors);
        }

        $builder->orderBy('b.' . $sortInput->getField(), $sortInput->getDirection());

        return $builder->getQuery()->getResult();
    }
}
