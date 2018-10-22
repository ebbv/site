<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, RecordsActivity;

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
        return route('directory.index').'/'.$this->id;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
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
        return session('isAdmin');
    }

    public function emails()
    {
        return $this->belongsToMany(Email::class)->withPivot('type')->orderBy('type');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    public function phones()
    {
        return $this->belongsToMany(Phone::class)->orderBy('type');
    }

    public function assign($relationship, $value, $extras = [])
    {
        $model = 'App\\'.ucfirst($relationship).'User';

        if (is_array($value)) {
            foreach ($value as $id) {
                $model::firstOrCreate([
                    $relationship.'_id' => $id,
                    'user_id'           => $this->id
                ]);
            }
        } else {
            $model::firstOrCreate(array_merge(
                [
                    $relationship.'_id' => $value,
                    'user_id'           => $this->id
                ],
                $extras
            ));
        }
    }
}
