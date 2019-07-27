<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Message extends Model
{
    use RecordsActivity;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'passage', 'filename', 'date'
    ];

    /**
     * The audio format extensions that are acceptable
     *
     * @var array
     */
    const AUDIO_FORMATS = ['audio/mpeg' => '.mp3', 'audio/ogg' => '.ogg'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $slug       = Str::slug($model->title);
            $original   = $slug;
            $count      = 2;

            while (static::whereSlug($slug)->exists()) {
                $slug = $original.'-'.$count++;
            }

            $model->attributes['slug'] = $slug;
            $model->attributes['filename'] = str_random(15);
        });
    }

    public function path()
    {
        return 'messages/'. $this->slug;
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
            $formatted = utf8_encode($formatted);
        }

        return $formatted;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
