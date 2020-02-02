<?php

namespace App\Validator;

use App\Repository\RepositoryInterface;

class NoRecordExists extends \Laminas\Validator\AbstractValidator
{
    private RepositoryInterface $repository;
    private string $field;

    /**
     * Error constants
     */
    public const ERROR_NO_RECORD_FOUND = 'noRecordFound';
    public const ERROR_RECORD_FOUND    = 'recordFound';

    /**
     * @var array Message templates
     */
    protected array $messageTemplates = [
        self::ERROR_NO_RECORD_FOUND => "No record matching the input was found",
        self::ERROR_RECORD_FOUND => "A record matching the input was found",
    ];

    /**
     * @param \App\Repository\RepositoryInterface $repository
     * @param string $field
     */
    public function __construct(RepositoryInterface $repository, $field)
    {
        parent::__construct($options = []);
        $this->repository = $repository;
        $this->field = $field;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value): bool
    {
        $valid = true;
        $this->setValue($value);

        $result = $this->query($value);
        if ($result) {
            $valid = false;
            $this->error(self::ERROR_RECORD_FOUND);
        }

        return $valid;
    }

    /**
     * @param string $value
     * @return object
     */
    protected function query($value): ?object
    {
        return $this->repository->findOneBy([$this->field => $value]);
    }
}
