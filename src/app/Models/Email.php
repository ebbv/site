<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model {

    protected $guarded = ['created_at', 'updated_at'];
    public $incrementing = false;

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
