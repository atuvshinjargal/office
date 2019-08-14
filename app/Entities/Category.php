<?php

namespace TaskSharing\Entities;

use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Category extends Model implements Transformable, SluggableInterface
{
    use TransformableTrait, SluggableTrait;

    /**
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug'
    ];

    /**
     * @var array
     */
    protected $fillable = ['name','slug','description'];
}
