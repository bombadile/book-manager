<?php

declare(strict_types=1);

namespace App\Service;

use App\Input\AuthorInput;
use App\Model\Author;
use App\Repository\RepositoryInterface;
use App\Validator\ValidatorInterface;

class AuthorService extends AbstractService
{
    private RepositoryInterface $authorRepository;

    /**
     * @param \App\Validator\ValidatorInterface $validator
     * @param \App\Repository\RepositoryInterface $authorRepository
     */
    public function __construct(
        ValidatorInterface $validator,
        RepositoryInterface $authorRepository
    ) {
        parent::__construct($validator);
        $this->authorRepository = $authorRepository;
    }

    /**
     * @param \App\Input\AuthorInput $authorInput
     * @return \App\Model\Author|null
     */
    public function getAuthor(AuthorInput $authorInput): ?Author
    {
        /** @var Author $author */
        $author = $this->authorRepository->findOneBy(['id' => $authorInput->getId()]);
        return $author;
    }
}
