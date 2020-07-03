<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
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

    public function dates()
    {
        return $this->hasMany(DateSong::class)->orderBy('date', 'desc');
    }

    public function songbooks()
    {
        return $this->belongsToMany(Songbook::class)->using(SongSongbook::class)->withPivot('number');
    }

    public function scopeSearchByNum($q, $input)
    {
        return $q->whereHas('songbooks', function ($query) use ($input) {
            return $query->where('songbook_id', $input['recueil'])->where('number', $input['num']);
        });
    }
}
