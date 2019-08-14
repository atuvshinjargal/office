<?php

namespace TaskSharing\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ClientCriteria implements CriteriaInterface
{
    /**
     * @param $model
     * @param RepositoryInterface $repositoryInterface
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repositoryInterface)
    {
        return $model->clients();
    }
}
