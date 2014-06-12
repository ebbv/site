<?php

class Message extends Eloquent {

    public function member()
    {
        return $this->belongsTo('Member');
    }

    public function speaker()
    {
        return $this->member();
    }
}