<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, RecordWhoCreatesAndUpdates;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'password', 'address_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function path()
    {
        return route('directory').'/'.$this->id;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps()->withPivot('created_by', 'updated_by');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function speaker()
    {
        return $this->roles()->where('name', 'orateur');
    }

    public function getIsAdminAttribute()
    {
        return ($this->roles()->where('name', 'administrateur')->count() === 0) ? false : true;
    }

    public function emails()
    {
        return $this->belongsToMany(Email::class)->withTimestamps()->withPivot('created_by', 'updated_by');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    public function phones()
    {
        return $this->belongsToMany(Phone::class)->withTimestamps()->withPivot('created_by', 'updated_by');
    }

    public function assign($relationship, $value)
    {
        $relationship = $relationship.'s';

        $this->$relationship()->attach($value, [
            'created_by' => auth()->id() ?: 1,
            'updated_by' => auth()->id() ?: 1
        ]);
    }
}
