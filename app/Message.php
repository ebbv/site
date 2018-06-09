<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'passage', 'url', 'date', 'created_by', 'updated_by'
    ];

    public function path()
    {
        return 'message/'. $this->id;
    }

    public function speaker()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
