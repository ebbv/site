<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
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
        'number', 'type'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('sort', function (Builder $builder) {
            $builder->orderBy('number');
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function assignTo($user)
    {
        PhoneUser::create([
            'phone_id' => $this->id,
            'user_id'  => $user
        ]);
    }
}
