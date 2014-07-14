<?php

class Message extends Eloquent {

    public function speaker()
    {
        return $this->belongsTo('Member', 'member_id');
    }
}