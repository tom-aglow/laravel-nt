<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user () {
        return $this->belongsTo('App\Models\User');
    }
}
