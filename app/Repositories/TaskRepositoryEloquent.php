<?php

namespace TaskSharing\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Contracts\ValidatorInterface;
use TaskSharing\Entities\Task;

/**
 * Class TaskRepositoryEloquent
 * @package namespace TaskSharing\Repositories;
 */
class TaskRepositoryEloquent extends BaseRepository implements TaskRepository
{
    /**
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'       => 'required',
            'category_id'=> 'sometimes|exists:categories,id',
            'status'     => 'required|numeric|in:0,1,2',
            'start_date' => 'required|date_format:Y-m-d',
            'due_date'   => 'date_format:Y-m-d',
            'priority'   => 'required|numeric'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'       => 'required',
            'category_id'=> 'sometimes|exists:categories,id',
            'status'     => 'required|numeric|in:0,1,2',
            'start_date' => 'required|date_format:Y-m-d',
            'due_date'   => 'date_format:Y-m-d',
            'priority'   => 'required|numeric'
        ]
    ];

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => 'like',
        'category_id' => '=',
        'start_date' => '=',
        'due_date' => '=',
        'status' => '=',
        'priority' => '='
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Task::class;
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
            $task = $this->create($attributes);

            if (array_has($attributes, 'clients')) {
                $task->client()->sync(array_get($attributes, 'clients'));
            }

            return $task;
        }

        $task = $this->update($attributes, $id);

        if (array_has($attributes, 'clients')) {
            $task->client()->sync(array_get($attributes, 'clients'));
        }

        return $task;
    }

    /**
     * @param int|null $key
     *
     * @return array
     */
    public function status($key = null)
    {
        $status = [
            0 => 'Closed',
            1 => 'Open',
            2 => 'Completed'
        ];

        if (! is_null($key) && array_has($status, $key)) {
            return array_get($status, $key);
        }

        return $status;
    }

    /**
     * @param string $note
     * @param int $id
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function note($note, $id)
    {
        $model = $this->find($id);
        $model->note()->attach(auth()->user()->id, ['note' => $note]);

        return $model;
    }

    /**
     * @param int $id
     */
    public function destroy($id)
    {
        $task = $this->find($id);
        $task->note()->detach();
        $task->client()->detach();
        $task->delete();
    }
}