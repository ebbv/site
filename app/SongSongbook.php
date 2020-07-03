<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SongSongbook extends Pivot
{
    use RecordsActivity;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
