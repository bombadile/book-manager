<?php

declare(strict_types=1);

namespace App\Controller;

use App\Input\AbstractInput;
use App\Service\AbstractService;
use App\Service\ServiceException;
use TheCodingMachine\GraphQLite\Exceptions\GraphQLAggregateException;
use TheCodingMachine\GraphQLite\Exceptions\GraphQLException;

abstract class AbstractController
{

    protected AbstractService $service;

    /**
     * @param callable $action
     * @return mixed
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLException
     */
    protected function process(callable $action)
    {
        try {
            $result = $action();
        } catch (ServiceException $e) {
            throw new GraphQLException($e->getMessage(), 400);
        }

        return $result;
    }

    /**
     * @param \App\Input\AbstractInput $object
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLAggregateException
     */
    protected function validate(AbstractInput $object)
    {
        if (!$this->service->isValid($object)) {
            $this->throwsErrorsValidation($this->service->getErrorsValidation());
        }
    }

    /**
     * @param \App\Validator\ErrorValidation[] $errors
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLAggregateException
     */
    private function throwsErrorsValidation(array $errors): void
    {
        $exceptions = new GraphQLAggregateException();

        foreach ($errors as $error) {
            $exceptions->add(
                new GraphQLException(
                    $error->getMessage(),
                    400,
                    null,
                    'VALIDATION',
                    ['field' => $error->getField()]
                )
            );
        }

        throw $exceptions;
    }
}
