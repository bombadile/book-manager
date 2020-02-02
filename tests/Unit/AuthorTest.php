<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Input\AuthorInput;
use App\Model\Author;
use App\Model\Book;
use App\Repository\AuthorRepository;
use App\Service\AuthorService;
use App\Validator\AuthorValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AuthorTest extends TestCase
{
    private AuthorService $service;
    private MockObject $authorRepository;

    public function setUp(): void
    {
        parent::setUp();

        /** @var AuthorRepository|MockObject $authorRepository */
        $authorRepository = $this->createMock(AuthorRepository::class);
        $this->authorRepository = $authorRepository;

        $validator = new AuthorValidator($this->authorRepository);

        $this->service = new AuthorService($validator, $this->authorRepository);
    }

    public function testGetAuthor(): void
    {
        $authorInput = (new AuthorInput())->setId(1);

        /** @var Book|MockObject $authorMock */
        $authorMock = $this->createMock(Author::class);
        $bookMock = new Book('test');

        $authorMock->expects($this->any())->method('getBooks')->willReturn([$bookMock]);
        $this->authorRepository->expects($this->any())->method('findOneBy')->willReturn($authorMock);

        $book = $this->service->getAuthor($authorInput);

        $this->assertInstanceOf(Author::class, $book);
        $this->assertInstanceOf(Book::class, $book->getBooks()[0]);
    }
}
