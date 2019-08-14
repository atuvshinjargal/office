<?php

namespace TaskSharing\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository
 * @package namespace TaskSharing\Repositories;
 */
interface CategoryRepository extends RepositoryInterface
{
    /**
     * @param string $name
     * @param null|string $key
     *
     * @return mixed
     */
    public function lists($name, $key = null);
}
