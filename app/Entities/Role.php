<?php

namespace TaskSharing\Entities;

use Bican\Roles\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Bican\Roles\Traits\RoleHasRelations;
use Bican\Roles\Contracts\RoleHasRelations as RoleHasRelationsContract;

class Role extends Model implements Transformable, RoleHasRelationsContract
{
    use TransformableTrait, RoleHasRelations, Slugable;

    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'level'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = $model->name;
        });
    }
}
