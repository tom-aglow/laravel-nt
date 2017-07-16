<?php

use Illuminate\Support\Facades\Route;

/**
 * Routes for file downloading
 */

Route::get('download/{path}','FileController@download')
    ->where([
        'path' => '[\w\.]+',
    ]);
Route::get('get/{path}','FileController@get')
    ->where([
        'path' => '[\w\.]+',
    ]);

