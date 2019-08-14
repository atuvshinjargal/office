<?php

namespace TaskSharing\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Task extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var array
     */
    protected $fillable = ['name','category_id','start_date','due_date','status','priority','description'];

    /**
     * @var array
     */
    protected $dates = ['start_date','due_date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne('TaskSharing\Entities\Category', 'id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function client()
    {
        return $this->belongsToMany('TaskSharing\Entities\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function note()
    {
        return $this->belongsToMany('TaskSharing\Entities\User', 'task_note')->withPivot(['note'])->withTimestamps();
    }

    /**
     * @param string $value
     */
    public function setDueDateAttribute($value)
    {
        if ($value === '0000-00-00') {
            $value = null;
        }

        $this->attributes['due_date'] = $value;
    }

    /**
     * @return string
     */
    public function getDueDateTransformAttribute()
    {
        $date = $this->due_date;

        if ($date->year < 0) {
            return '-';
        }

        return $this->due_date->format('d.m.Y');
    }

    /**
     * @param $value
     *
     * @return \Carbon\Carbon|string
     */
    public function getDueDateAttribute($value)
    {
        if (is_null($value)) {
            $value = '0000-00-00';
        }

        return $this->asDateTime($value);
    }

    /**
     * @param $query
     * @param int|null $status
     *
     * @return mixed
     */
    public function scopeStatus($query, $status = null)
    {
        if (! is_null($status) && is_numeric($status)) {
            return $query->whereStatus($status);
        }

        return $query;
    }

    /**
     * @param $query
     * @param string $start
     * @param string $end
     *
     * @return mixed
     */
    public function scopeCalendarTasks($query, $start, $end)
    {
        return $query->where('start_date', '>=', $start)->where(function ($q) use ($end) {
            $q->where('due_date', '<=', $end)->whereNotNull('due_date');
        });
    }

    /**
     * @return mixed
     */
    public function getColorAttribute()
    {
        $colors = config('task.priority');

        return $colors[$this->priority];
    }
}
