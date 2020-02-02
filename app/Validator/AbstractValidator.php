<?php

declare(strict_types=1);

namespace App\Validator;

use App\Input\AbstractInput;
use App\Repository\RepositoryInterface;
use Laminas\Validator\ValidatorChain;

abstract class AbstractValidator implements ValidatorInterface
{
    private array $errors = [];

    protected RepositoryInterface $repository;

    abstract protected function rules(): array;

    /**
     * @param \App\Repository\RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param AbstractInput $object
     * @return bool
     */
    public function isValid(AbstractInput $object): bool
    {
        $this->validate($object);

        if ($this->hasErrors()) {
            return false;
        }

        return true;
    }

    /**
     * @return \App\Validator\ErrorValidation[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param AbstractInput $object
     * @return void
     */
    private function validate(AbstractInput $object): void
    {
        $rules = $this->rules();

        if (empty($rules)) {
            return;
        }

        foreach ($rules as $field => $constraints) {
            $value = $this->getFieldValue($object, $field);

            if ($value === null) {
                continue;
            }

            $this->validateField($field, $value, $constraints);
        }
    }

    /**
     * @param AbstractInput $object
     * @param $field
     * @return mixed
     */
    private function getFieldValue(AbstractInput $object, string $field)
    {
        $methodName = 'get' . ucfirst($field);
        if (method_exists($object, $methodName)) {
            return $object->{$methodName}();
        }
        return null;
    }

    /**
     * @param string $field
     * @param $value
     * @param array $constraints
     */
    private function validateField(string $field, $value, array $constraints): void
    {
        $validatorChain = new ValidatorChain();
        foreach ($constraints as $constraint) {
            $validatorChain->attach($constraint);
        }
        if (!$validatorChain->isValid($value)) {
            foreach ($validatorChain->getMessages() as $message) {
                $this->addError($field, $message);
            }
        }
    }

    /**
     * @return bool
     */
    private function hasErrors(): bool
    {
        if (empty($this->getErrors())) {
            return false;
        }

        return true;
    }

    /**
     * @param string $field
     * @param string $message
     */
    private function addError(string $field, string $message): void
    {
        $this->errors[] = (new ErrorValidation())->setField($field)->setMessage($message);
    }
}
