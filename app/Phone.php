<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use RecordWhoCreatesAndUpdates;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'number', 'type'
    ];

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
