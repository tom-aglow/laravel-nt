<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CommentStatus;

class Comment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * RELATIONSHIPS
     */

    public function article () {
        return $this->belongsTo('App\Models\Article');
    }

    public function user () {
        return $this->belongsTo('App\Models\User');
    }

    public function status () {
        return $this->belongsTo('App\Models\CommentStatus');
    }
}
