<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function thread () {
        return $this->belongsTo('App\Models\Thread');
    }

    public function owner () {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
