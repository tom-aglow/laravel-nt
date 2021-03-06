<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];


    /**
     * RELATIONSHIPS
     */

    public function articles () {
        return $this->belongsToMany('App\Models\Article');
    }
}
