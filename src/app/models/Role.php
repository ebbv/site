<?php

class Role extends Eloquent {

    public function members()
    {
        return $this->belongsToMany('Member')->withTimestamps()->withPivot('created_by', 'updated_by');
    }
}