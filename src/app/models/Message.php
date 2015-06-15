<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $guarded = array('id', 'created_at', 'updated_at');

    public function speaker()
    {
        return $this->belongsTo('App\Models\Member', 'member_id');
    }
}