<?php

declare(strict_types=1);

namespace App\Validator;

use Laminas\Validator\EmailAddress;
use Laminas\Validator\StringLength;

class AuthorValidator extends AbstractValidator
{
    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'name' => [
                new StringLength(['min' => 2, 'max' => 255])
            ],
            'surname' => [
                new StringLength(['min' => 2, 'max' => 255])
            ],
            'email' => [
                new StringLength(['min' => 5, 'max' => 255]),
                new EmailAddress(),
                new NoRecordExists($this->repository, 'email')
            ],
        ];
    }
}
