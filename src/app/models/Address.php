<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

    protected $guarded = array('created_at', 'updated_at');
    public $incrementing = false;

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }
}
