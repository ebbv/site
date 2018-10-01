<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street_info', 'street_complement', 'zip', 'city', 'created_by', 'updated_by'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getStreetAddressAttribute()
    {
        return $this->street_info;
    }
}
