<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /*
     * Relationships
     */
    public function subject () {
        return $this->morphTo();
    }
}
