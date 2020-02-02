<?php

declare(strict_types=1);

namespace App\Service;

use App\Input\BookFilterInput;
use App\Input\BookInput;
use App\Input\BookSortInput;
use App\Model\Book;
use App\Repository\RepositoryInterface;
use App\Validator\ValidatorInterface;

class BookService extends AbstractService
{
    private RepositoryInterface $bookRepository;

    /**
     * @param \App\Validator\ValidatorInterface $validator
     * @param \App\Repository\RepositoryInterface $bookRepository
     */
    public function __construct(
        ValidatorInterface $validator,
        RepositoryInterface $bookRepository
    ) {
        parent::__construct($validator);
        $this->bookRepository = $bookRepository;
    }

    /**
     * @param \App\Input\BookFilterInput $filterInput
     * @param \App\Input\BookSortInput $sortInput
     * @return Book[]|null
     */
    public function getBooks(BookFilterInput $filterInput, BookSortInput $sortInput): ?array
    {
        return $this->bookRepository->findBy($filterInput, $sortInput);
    }

    /**
     * @param \App\Input\BookInput $bookInput
     * @return \App\Model\Book|null
     */
    public function getBook(BookInput $bookInput): ?Book
    {
        /** @var Book $book */
        $book = $this->bookRepository->findOneBy(['id' => $bookInput->getId()]);
        return $book;
    }
}
