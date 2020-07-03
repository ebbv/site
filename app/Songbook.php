<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Songbook extends Model
{
    use RecordsActivity;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function songs()
    {
        return $this->belongsToMany(Song::class)->using(SongSongbook::class)->withPivot('number');
    }
}
