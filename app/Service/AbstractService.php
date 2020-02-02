<?php

declare(strict_types=1);

namespace App\Service;

use App\Input\AbstractInput;
use App\Model\AbstractModel;
use App\Validator\ValidatorInterface;
use App\Repository\RepositoryInterface;

abstract class AbstractService
{
    protected ValidatorInterface $validator;

    /**
     * @param \App\Validator\ValidatorInterface $validator
     */
    public function __construct(
        ValidatorInterface $validator
    ) {
        $this->validator = $validator;
    }

    /**
     * @param \App\Input\AbstractInput $object
     * @return bool
     */
    public function isValid(AbstractInput $object): bool
    {
        return $this->validator->isValid($object);
    }

    /**
     * @return \App\Validator\ErrorValidation[]
     */
    public function getErrorsValidation(): array
    {
        return $this->validator->getErrors();
    }

    /**
     * @param \App\Repository\RepositoryInterface $repository
     * @param int $id
     * @return \App\Model\AbstractModel
     */
    protected function getModel(RepositoryInterface $repository, int $id): AbstractModel
    {
        $model = $repository->findOneBy(['id' => $id]);

        if (!$model) {
            throw new ServiceException($repository->getModelName() . ' is not found');
        }

        return $model;
    }
}
