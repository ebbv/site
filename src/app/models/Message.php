<?php

class Message extends Eloquent {

    protected $guarded = array('id', 'created_at', 'updated_at');

    public function speaker()
    {
        return $this->belongsTo('Member', 'member_id');
    }
}