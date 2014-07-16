<?php

use Illuminate\Auth\UserInterface;

class Member extends Eloquent implements UserInterface {

    public function roles()
    {
        return $this->belongsToMany('Role')->withTimestamps()->withPivot('created_by', 'updated_by');
    }

    public function messages()
    {
        return $this->hasMany('Message');
    }

    public function speaker()
    {
        return $this->roles()->where('name', '=', 'orateur');
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