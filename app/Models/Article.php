<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id', 'created_at', 'updated_at'];


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
//    TODO show list of active article in client side (+ think about pagination)
}
