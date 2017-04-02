<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'member_id', 'title', 'passage', 'url', 'date', 'created_by', 'updated_by'
    ];

    public function speaker()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
