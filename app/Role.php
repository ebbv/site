<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Trackable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('sort', function (Builder $builder) {
            $builder->orderBy('name');
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('created_by', 'updated_by');
    }

    public function assignTo($user)
    {
        $this->users()->attach($user, [
            'created_by' => auth()->id() ?: 1,
            'updated_by' => auth()->id() ?: 1
        ]);
    }
}
