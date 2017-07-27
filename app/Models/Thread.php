<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /*
     * Methods
     */
    public function path () {
        return '/threads/' . $this->id;
    }

    public function addReply ($reply) {
        $this->replies()->create($reply);
    }

    /*
     * Relationships
     */

    public function replies () {
        return $this->hasMany('App\Models\Reply');
    }

    public function creator () {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
