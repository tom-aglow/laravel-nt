<?php

namespace App\Models;

use App\Http\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use RecordsActivity;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function favourited () {
        return $this->morphTo();
    }
}
