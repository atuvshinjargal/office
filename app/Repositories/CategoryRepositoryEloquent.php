<?php

namespace TaskSharing\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use TaskSharing\Entities\Category;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace TaskSharing\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Validator Rules
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'  => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'  => 'required'
        ]
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param string $name
     * @param null|string $key
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function lists($name, $key = null)
    {
        return $this->makeModel()->lists($name, $key);
    }
}
