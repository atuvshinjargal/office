<?php

namespace TaskSharing\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Contracts\ValidatorInterface;
use TaskSharing\Entities\Command;

/**
 * Class CommandRepositoryEloquent
 * @package namespace CommandSharing\Repositories;
 */
class CommandRepositoryEloquent extends BaseRepository implements CommandRepository
{
    /**
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'number'     => 'required',
            'name'       => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'pdf'        => 'required|mimes:pdf|max:10000',
            'category'   => 'required|numeric|in:0,1,2'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'number'     => 'required',
            'name'       => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'pdf'        => 'mimes:pdf|max:10000',
            'category'   => 'required|numeric|in:0,1,2'
        ]
    ];

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'number' => 'like',
        'name' => 'like',
        'start_date' => '=',
        'category' => '=',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Command::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param array $attributes
     * @param int|null $id
     *
     * @return mixed
     */
    public function save(array $attributes = [], $id = null)
    {
        if (is_null($id)) {
            $command = $this->create($attributes);
            return $command;
        }

        $command = $this->update($attributes, $id);

        return $command;
    }

    /**
     * @param int|null $key
     *
     * @return array
     */
    public function category($key = null)
    {
        $category = [
            0 => 'Тушаал',
            1 => 'Захирамж',
            2 => 'Шийдвэр'
        ];

        if (! is_null($key) && array_has($category, $key)) {
            return array_get($category, $key);
        }

        return $category;
    }

    /**
     * @param int $id
     */
    public function destroy($id)
    {
        $command = $this->find($id);
        $command->delete();
    }
}