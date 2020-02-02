<?php

declare(strict_types=1);

namespace App\Controller;

use App\Input\BookFilterInput;
use App\Input\BookInput;
use App\Input\BookSortInput;
use App\Model\Book;
use App\Service\BookService;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\GraphQLite\Annotations\Mutation;
use TheCodingMachine\GraphQLite\Annotations\UseInputType;

class BookController extends AbstractController
{

    /**
     * @param \App\Service\BookService $service
     */
    public function __construct(BookService $service)
    {
        $this->service = $service;
    }

    /**
     * @Query
     * @UseInputType(for="$bookInput", inputType="GetBookInput!")
     * @param \App\Input\BookInput $bookInput
     * @return Book
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLException
     */
    public function getBook(BookInput $bookInput): ?Book
    {
        return $this->process(
            function () use ($bookInput) {
                return $this->service->getBook($bookInput);
            }
        );
    }

    /**
     * @Query
     * @UseInputType(for="$bookFilterInput", inputType="GetBooksFilterInput!")
     * @UseInputType(for="$bookSortInput", inputType="GetBooksSortInput!")
     * @param \App\Input\BookFilterInput $bookFilterInput
     * @param \App\Input\BookSortInput $bookSortInput
     * @return Book[]|null
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLAggregateException
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLException
     */
    public function getBooks(BookFilterInput $bookFilterInput, BookSortInput $bookSortInput): ?array
    {
        $this->validate($bookFilterInput);
        return $this->process(
            function () use ($bookFilterInput, $bookSortInput) {
                return $this->service->getBooks($bookFilterInput, $bookSortInput);
            }
        );
    }
}
