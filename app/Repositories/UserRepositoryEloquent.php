<?php

namespace TaskSharing\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use TaskSharing\Entities\User;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class UserRepositoryEloquent
 * @package namespace TaskSharing\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Validator Rules
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|exists:roles,id'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'sometimes|confirmed|min:6',
            'role' => 'required|exists:roles,id'
        ]
    ];

    /**
     * Specify Model class name
     *
     * @return User
     */
    public function model()
    {
        return User::class;
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
     *
     * @return mixed
     */
    public function addUser(array $attributes = [])
    {
        $user = $this->create($attributes);
        $user->attachRole(array_get($attributes, 'role'));

        return $user;
    }

    /**
     * @param array $attributes
     * @param int $id
     *
     * @return mixed
     */
    public function editUser(array $attributes = [], $id)
    {
        $user = $this->update($attributes, $id);
        $user->detachAllRoles();
        $user->attachRole(array_get($attributes, 'role'));

        return $user;
    }

    /**
     * @param string $search
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function search($search)
    {
        return $this->makeModel()->clientFind($search)->select('name', 'id')->get();
    }

    /**
     * @param int|null $id
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function closedTasks($id = null)
    {
        return $this->myTasks($id)->status(0);
    }

    /**
     * @param int|null $id
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function openTasks($id = null)
    {
        return $this->myTasks($id)->status(1);
    }

    /**
     * @param int|null $id
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function completedTasks($id = null)
    {
        return $this->myTasks($id)->status(2);
    }

    /**
     * @param int|null $id
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function myTasks($id = null)
    {
        if (is_null($id)) {
            $id = auth()->user()->id;
        }

        return $this->makeModel()->find($id)->tasks();
    }

    /**
     * @return array
     */
    public function myTasksInformation()
    {
        return [
            'total' => $this->myTasks()->count(),
            'completed' => $this->completedTasks()->count(),
            'closed' => $this->closedTasks()->count(),
            'open' => $this->openTasks()->count()
        ];
    }

    /**
     * @param string $start
     * @param string $end
     *
     * @return mixed
     */
    public function calendarTasks($start, $end)
    {
        $priorities = config('task.priority');

        return $this->myTasks()->calendarTasks($start, $end)->get()->transform(function ($item) use ($priorities) {

            return [
                'title' => $item->name,
                'start' => $item->start_date->format('Y-m-d'),
                'end' => $item->due_date->format('Y-m-d'),
                'className' => in_array($item->status, [0, 2]) ? ' disabled' : '',
                'backgroundColor' => $priorities[$item->priority],
                'borderColor' => $priorities[$item->priority],
                'url' => route('task', $item->id)
            ];
        });
    }

    /**
     * @param int|null $id
     *
     * @return \Illuminate\Support\Collection
     */
    public function tasks($id = null)
    {
        return collect([
            'all' => $this->myTasks($id)->latest()->paginate(),
            'open' => $this->openTasks($id)->latest()->paginate(),
            'closed' => $this->closedTasks($id)->latest()->paginate(),
            'completed' => $this->completedTasks($id)->latest()->paginate()
        ]);
    }

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function updateNote(array $attributes = [])
    {
        $task = $this->myTasks()->find(array_get($attributes, 'id'));

        switch (array_get($attributes, 'type')) {
            case 'note':
                if (array_get($attributes, 'note') !== "") {
                    $task->note()->attach(auth()->user()->id, ['note' => array_get($attributes, 'note')]);
                }
            break;
            case 'complete':
                $task->status = 2;
                $task->save();
            break;
        }
    }
}
