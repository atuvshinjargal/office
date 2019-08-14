<?php

namespace TaskSharing\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, HasRoleAndPermissionContract, Transformable
{
    use Authenticatable, CanResetPassword, HasRoleAndPermission, TransformableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany('TaskSharing\Entities\Task', 'task_user');
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        if (! empty($value) && $value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    /**
     * @param $query
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\ScopeInterface
     */
    public function scopeClients($query, $slug = 'client')
    {
        return $query->whereHas('roles', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }

    /**
     * @param $query
     * @param null $search
     *
     * @return \Illuminate\Database\Eloquent\ScopeInterface
     */
    public function scopeClientFind($query, $search = null)
    {
        if (is_null($search)) {
            return;
        }

        if (! filter_var($search, FILTER_VALIDATE_EMAIL)) {
            return $query->where('name', 'like', '%'. $search .'%');
        }

        return $query->where('email', 'like', '%'. $search .'%');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->detachAllRoles();
        });
    }
}
