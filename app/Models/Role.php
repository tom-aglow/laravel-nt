<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     *  RELATIONSHIPS
     */
    public function users () {
        return $this->hasMany('App\Models\User');
    }
    public function privileges () {
        return $this->belongsToMany('App\Models\Privilege');
    }
}
