<?php

declare(strict_types=1);

namespace App\Input;

use TheCodingMachine\GraphQLite\Annotations\Type;
use TheCodingMachine\GraphQLite\Annotations\Field;

/**
 * @Type()
 */
class BookSortInput extends AbstractInput
{
    private string $field;

    private string $direction;

    /**
     * @Field()
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @Field()
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @param string $field
     * @return BookSortInput
     */
    public function setField(string $field): BookSortInput
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @param string $direction
     * @return BookSortInput
     */
    public function setDirection(string $direction): BookSortInput
    {
        $this->direction = $direction;
        return $this;
    }
}
