<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Favourable;

class Reply extends Model
{
    use Favourable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = ['owner', 'favourites'];

    /*
     * Relationships
     */
    public function thread () {
        return $this->belongsTo('App\Models\Thread');
    }

    public function owner () {
        return $this->belongsTo('App\Models\User', 'user_id');
    }


}
