<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use RecordWhoCreatesAndUpdates;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('created_by', 'updated_by');
    }
}
