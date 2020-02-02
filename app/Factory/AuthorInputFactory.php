<?php

declare(strict_types=1);

namespace App\Factory;

use App\Input\AuthorInput;
use TheCodingMachine\GraphQLite\Annotations\Factory;

class AuthorInputFactory
{
    /**
     * @Factory(name="GetAuthorInput", default=false)
     * @param int $id
     * @return \App\Input\AuthorInput
     */
    public function getAuthor(int $id): AuthorInput
    {
        return (new AuthorInput())->setId($id);
    }
}
