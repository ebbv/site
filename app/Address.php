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
        'steet_number', 'street_type', 'street_name', 'street_complement',
        'zip', 'city', 'created_by', 'updated_by'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getStreetAddressAttribute()
    {
        $street_number = $this->street_number ? $this->street_number.', ' : '';

        return "{$street_number}{$this->street_type} {$this->street_name}";
    }
}
