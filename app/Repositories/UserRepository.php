<?php

namespace TaskSharing\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace TaskSharing\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    /**
     * @param array $attribute
     *
     * @return mixed
     */
    public function addUser(array $attribute = []);

    /**
     * @param array $attributes
     * @param $id
     *
     * @return mixed
     */
    public function editUser(array $attributes = [], $id);

    /**
     * @param string $search
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function search($search);

    /**
     * @return array
     */
    public function myTasksInformation();

    /**
     * @param string $start
     * @param string $end
     *
     * @return mixed
     */
    public function calendarTasks($start, $end);

    /**
     * @param int|null $id
     *
     * @return mixed
     */
    public function tasks($id = null);

    /**
     * @return mixed
     */
    public function myTasks();

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function updateNote(array $attributes = []);
}
