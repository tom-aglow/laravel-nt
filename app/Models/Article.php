<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Casting
     */

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * SCOPE: Does article have flag active
     */
    public function scopeActive($query) {
        return $query->where('is_active', 1);
    }

    /**
     * SCOPE: Is article active at present moment of time
     */
    public function scopeInTime($query) {

        return $query->where(function ($query) {
            $query->orWhere(function ($query) {
                $query->where(DB::raw('NOW()'), '>=', DB::raw('active_from'))->where(DB::raw('NOW()'), '<', DB::raw('active_to'));
            })->orWhere(function ($query) {
                $query->where(DB::raw('NOW()'), '>=', DB::raw('active_from'))->whereNull('active_to');
            });
        });
    }

    /**
     * RELATIONSHIPS
     */

    public function comments () {
        return $this->hasMany('App\Models\Comment');
    }

    public function user () {
        return $this->belongsTo('App\Models\User');
    }

    public function image () {
        return $this->belongsTo('App\Models\Upload');
    }

    public function tags () {
        return $this->belongsToMany('App\Models\Tag');
    }
}
