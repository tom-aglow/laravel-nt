<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getRouteKeyName () {
        return 'username';
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'email'];

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

    public function replies () {
        return $this->hasMany('App\Models\Reply');
    }

    public function threads () {
        return $this->hasMany('App\Models\Thread');
    }

    public function activities () {
        return $this->hasMany('App\Models\Activity');
    }
}
