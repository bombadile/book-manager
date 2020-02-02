<?php

declare(strict_types=1);

namespace App\Factory;

use App\Enum\BookSortDirection;
use App\Enum\BookSortField;
use App\Input\BookFilterInput;
use App\Input\BookInput;
use App\Input\BookSortInput;
use TheCodingMachine\GraphQLite\Annotations\Factory;

class BookInputFactory
{
    /**
     * @Factory(name="GetBookInput", default=false)
     * @param int $id
     * @return \App\Input\BookInput
     */
    public function getBook(int $id): BookInput
    {
        return (new BookInput())->setId($id);
    }

    /**
     * @Factory(name="GetBooksFilterInput", default=false)
     * @param \DateTimeImmutable|null $releaseDateStart
     * @param \DateTimeImmutable|null $releaseDateEnd
     * @param int $countAuthors
     * @param int $limit
     * @param int $offset
     * @return \App\Input\BookFilterInput
     */
    public function getBooksFilter(
        ?\DateTimeImmutable $releaseDateStart,
        ?\DateTimeImmutable $releaseDateEnd,
        ?int $countAuthors,
        int $limit,
        int $offset
    ): BookFilterInput {
        return (new BookFilterInput())
            ->setReleaseDateStart($releaseDateStart)
            ->setReleaseDateEnd($releaseDateEnd)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setCountAuthors($countAuthors);
    }

    /**
     * @Factory(name="GetBooksSortInput", default=false)
     * @param \App\Enum\BookSortField $field
     * @param \App\Enum\BookSortDirection $direction
     * @return \App\Input\BookSortInput
     */
    public function getBooksSort(BookSortField $field, BookSortDirection $direction): BookSortInput
    {
        return (new BookSortInput())->setField($field->getValue())->setDirection($direction->getValue());
    }
}
