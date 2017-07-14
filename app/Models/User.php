<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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
        return $this->hasMany('App\Model\Comment');
    }

//    TODO make mutation for encrypting user's password
}
