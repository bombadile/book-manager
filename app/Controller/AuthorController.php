<?php

declare(strict_types=1);

namespace App\Controller;

use App\Input\AuthorInput;
use App\Model\Author;
use App\Service\AuthorService;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\GraphQLite\Annotations\Mutation;
use TheCodingMachine\GraphQLite\Annotations\UseInputType;

class AuthorController extends AbstractController
{

    /**
     * @param \App\Service\AuthorService $service
     */
    public function __construct(AuthorService $service)
    {
        $this->service = $service;
    }

    /**
     * @Query
     * @UseInputType(for="$authorInput", inputType="GetAuthorInput!")
     * @param \App\Input\AuthorInput $authorInput
     * @return \App\Model\Author|null
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLException
     */
    public function getAuthor(AuthorInput $authorInput): ?Author
    {
        return $this->process(
            function () use ($authorInput) {
                return $this->service->getAuthor($authorInput);
            }
        );
    }
}
