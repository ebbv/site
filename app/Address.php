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
        'user_id', 'steet_number', 'street_type', 'street_name', 'street_complement',
        'zip', 'city', 'created_by', 'updated_by'
    ];

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStreetAddressAttribute()
    {
        $street_number = $this->street_number ? $this->street_number.', ' : '';

        return "{$street_number}{$this->street_type} {$this->street_name}";
    }
}
