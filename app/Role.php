<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'created_by', 'updated_by'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('created_by', 'updated_by');
    }

    public function scopeStatus()
    {
        return $this->map(function ($item) {
            $item['checked'] = '';
            return $item;
        });
    }
}
