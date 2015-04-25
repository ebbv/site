<?php

class Email extends Eloquent {

    protected $guarded = array('created_at', 'updated_at');
    public $incrementing = false;

    public function member()
    {
        return $this->belongsTo('Member');
    }
}
