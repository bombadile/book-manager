<?php

declare(strict_types=1);

namespace App\Validator;

use App\Input\AbstractInput;

interface ValidatorInterface
{
    /**
     * @param \App\Input\AbstractInput $object
     * @return bool
     */
    public function isValid(AbstractInput $object): bool;

    /**
     * @return array
     */
    public function getErrors(): array;
}
