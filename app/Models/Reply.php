<?php

namespace App\Models;

use App\Http\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Favourable;

class Reply extends Model
{
    use Favourable, RecordsActivity;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = ['owner', 'favourites'];

    //  when cast array or json, we want to add these attributes to that
    protected $appends = ['favouriteCounts', 'isFavourited'];
    /*
     * Relationships
     */
    public function thread () {
        return $this->belongsTo('App\Models\Thread');
    }

    public function owner () {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /*
     * Methods
     */
    public function path () {
        return $this->thread->path() . '#reply-' . $this->id;
    }
}
