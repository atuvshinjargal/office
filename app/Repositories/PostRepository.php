<?php

namespace TaskSharing\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TaskRepository
 * @package namespace TaskSharing\Repositories;
 */
interface PostRepository extends RepositoryInterface
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
    public function category($key = null);


    /**
     * @param $id
     */
    public function destroy($id);
}
