<?php

declare(strict_types=1);

namespace App\Validator;

use Laminas\Validator\Date;
use Laminas\Validator\StringLength;

class BookValidator extends AbstractValidator
{
    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'title' => [
                new StringLength(['min' => 1, 'max' => 255])
            ],
            'releaseDate' => [
                new Date(['format' => 'Y-m-d H:i:s'])
            ],
            'releaseDateStart' => [
                new Date(['format' => 'Y-m-d H:i:s'])
            ],
            'releaseDateEnd' => [
                new Date(['format' => 'Y-m-d H:i:s'])
            ]
        ];
    }
}
