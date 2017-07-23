<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Mutator for user password
     */
    public function setPasswordAttribute ($value) {
        $this->attributes['password'] = bcrypt($value);
    }


    /**
     *  RELATIONSHIPS
     */
    public function articles () {
        return $this->hasMany('App\Models\Article');
    }

    public function comments () {
        return $this->hasMany('App\Models\Comment');
    }

    public function role () {
        return $this->belongsTo('App\Models\Role');
    }

    public function socialAccounts () {
        return $this->hasMany('App\Models\SocialAccount');
    }
}
