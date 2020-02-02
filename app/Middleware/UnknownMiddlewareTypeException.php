<?php

declare(strict_types=1);

namespace App\Middleware;

class UnknownMiddlewareTypeException extends \InvalidArgumentException
{
    private $type;

    /**
     * @param mixed $type
     */
    public function __construct($type)
    {
        parent::__construct('Unknown middleware type');
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}
