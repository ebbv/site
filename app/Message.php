<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use RecordWhoCreatesAndUpdates;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'passage', 'url', 'date'
    ];

    public function path()
    {
        return 'message/'. $this->id;
    }

    public function speaker()
    {
        return $this->belongsTo(User::class, 'user_id')
            ->select('id', 'last_name', 'first_name', 'username');
    }

    public function getFormattedDateAttribute()
    {
        $formatted = strftime("%e %B, %Y", strtotime($this->date));

        if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
            return utf8_encode($formatted);
        }

        return $formatted;
    }
}
