<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
        'name'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('sort', function (Builder $builder) {
            $builder->orderBy('name');
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeSpeaker($query)
    {
        return $query->where('name', 'orateur')->first('id', 'name');
    }

    public function assignTo($user)
    {
        if (is_array($user)) {
            foreach ($user as $id) {
                RoleUser::create([
                    'role_id' => $this->id,
                    'user_id' => $id['id']
                ]);
            }
        } else {
            RoleUser::create([
                'role_id' => $this->id,
                'user_id' => $user
            ]);
        }
    }
}
