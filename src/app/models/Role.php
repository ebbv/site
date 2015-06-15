<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    public function members()
    {
        return $this->belongsToMany('App\Models\Member')->withTimestamps()->withPivot('created_by', 'updated_by');
    }
}