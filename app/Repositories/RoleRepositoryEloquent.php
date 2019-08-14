<?php

namespace TaskSharing\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use TaskSharing\Entities\Role;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class RoleRepositoryEloquent
 * @package namespace TaskSharing\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /**
     * Specify Validator Rules
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'  => 'required',
            'level' => 'required|numeric'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'  => 'required',
            'level' => 'required|numeric'
        ]
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $name
     * @param null $key
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function lists($name, $key = null)
    {
        return $this->makeModel()->lists($name, $key);
    }
}
