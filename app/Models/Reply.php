<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /*
     * Relationships
     */
    public function thread () {
        return $this->belongsTo('App\Models\Thread');
    }

    public function owner () {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function favourites () {
        return $this->morphMany(Favourite::class, 'favourited');
    }

    /*
     * Methods
     */

    public function favourite () {
        $attributes = ['user_id' => auth()->id()];

        if (!$this->favourites()->where($attributes)->exists()) {
            return $this->favourites()->create($attributes);
        }
    }
}
