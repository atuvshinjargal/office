<?php

namespace TaskSharing\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Post extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var array
     */
    protected $fillable = ['title','text', 'source','category'];

    /**
     * @param $query
     * @param int|null $status
     *
     * @return mixed
     */
    public function scopeCategory($query, $category = null)
    {
        if (! is_null($category) && is_numeric($category)) {
            return $query->whereStatus($category);
        }

        return $query;
    }
}
