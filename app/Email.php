<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use RecordWhoCreatesAndUpdates;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'type'
    ];

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
