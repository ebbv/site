<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'address', 'type', 'created_by', 'updated_by'];

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
