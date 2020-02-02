<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Enum\BookSortDirection;
use App\Enum\BookSortField;
use App\Input\BookFilterInput;
use App\Input\BookInput;
use App\Input\BookSortInput;
use App\Model\Author;
use App\Model\Book;
use App\Repository\BookRepository;
use App\Service\BookService;
use App\Validator\BookValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    private BookService $service;

    private MockObject $bookRepository;

    public function setUp(): void
    {
        parent::setUp();

        /** @var BookRepository|MockObject $bookRepository */
        $bookRepository = $this->createMock(BookRepository::class);
        $this->bookRepository = $bookRepository;

        $validator = new BookValidator($this->bookRepository);

        $this->service = new BookService($validator, $this->bookRepository);
    }

    public function testGetBook(): void
    {
        $bookInput = (new BookInput())->setId(1);

        /** @var Book|MockObject $bookMock */
        $bookMock = $this->createMock(Book::class);
        $authorMock = new Author('test', 'test', 'test@test.ru');

        $bookMock->expects($this->any())->method('getAuthors')->willReturn([$authorMock]);
        $this->bookRepository->expects($this->any())->method('findOneBy')->willReturn($bookMock);

        $book = $this->service->getBook($bookInput);

        $this->assertInstanceOf(Book::class, $book);
        $this->assertInstanceOf(Author::class, $book->getAuthors()[0]);
    }

    public function testGetBooks()
    {
        $booksMock = [new Book('test')];
        $bookFilterInput = (new BookFilterInput())->setCountAuthors(3);
        $bookSortInput = (new BookSortInput())->setField(BookSortField::ID)->setDirection(BookSortDirection::ASC);

        $this->bookRepository->expects($this->any())->method('findBy')->willReturn($booksMock);

        $this->assertTrue($this->service->isValid($bookFilterInput));
        $books = $this->service->getBooks($bookFilterInput, $bookSortInput);
        $this->assertInstanceOf(Book::class, $books[0]);
    }
}
