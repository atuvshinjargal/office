<?php

namespace TaskSharing\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TaskRepository
 * @package namespace TaskSharing\Repositories;
 */
interface TaskRepository extends RepositoryInterface
{
    /**
     * @param array $attributes
     * @param int|null $id
     *
     * @return mixed
     */
    public function save(array $attributes = [], $id = null);

    /**
     * @param int|null $key
     *
     * @return mixed
     */
    public function status($key = null);

    /**
     * @param string $note
     * @param int $id
     *
     * @return mixed
     */
    public function note($note, $id);

    /**
     * @param $id
     */
    public function destroy($id);
}
