<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use RecordWhoCreatesAndUpdates;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street_info', 'street_complement', 'zip', 'city'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('sort', function (Builder $builder) {
            $builder->orderBy('zip')->orderBy('city');
        });
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getFullAddressAttribute()
    {
        return $this->street_info.' '.$this->street_complement.' '.$this->zip.' '.$this->city;
    }
}
