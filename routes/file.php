<?php

use Illuminate\Support\Facades\Route;

/**
 * Dynamic file routes
 */

Route::get('download/{path}','FileController@download')
    ->where([
        'path' => '[\w\.]+',
    ]);
Route::get('get/{path}','FileController@get')
    ->where([
        'path' => '[\w\.]+',
    ]);

