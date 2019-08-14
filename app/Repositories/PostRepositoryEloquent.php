<?php

namespace TaskSharing\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Contracts\ValidatorInterface;
use TaskSharing\Entities\Post;

/**
 * Class CommandRepositoryEloquent
 * @package namespace CommandSharing\Repositories;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    /**
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title'      => 'required',
            'text'       => 'required',
            'source'     => 'required',
            'category'   => 'required|numeric|in:0,1'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title'      => 'required',
            'text'       => 'required',
            'source'     => 'required',
            'category'   => 'required|numeric|in:0,1'
        ]
    ];

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title' => 'like',
        'source' => '=',
        'category' => '=',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
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
            $post = $this->create($attributes);
            return $post;
        }

        $post = $this->update($attributes, $id);

        return $post;
    }

    /**
     * @param int|null $key
     *
     * @return array
     */
    public function category($key = null)
    {
        $category = [
            0 => 'Мэдээлэл',
            1 => 'Шуурхай зар'
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
        $post = $this->find($id);
        $post->delete();
    }
}