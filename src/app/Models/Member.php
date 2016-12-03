<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Member extends Model implements AuthenticatableContract
{
    use Authenticatable;

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps()->withPivot('created_by', 'updated_by');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function speaker()
    {
        return $this->roles()->where('name', 'orateur');
    }

    public function admin()
    {
        return $this->roles()->where('name', 'administrateur');
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
