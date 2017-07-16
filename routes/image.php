<?php

use Illuminate\Support\Facades\Route;

/**
 * Dynamic image resizer routes
 */

Route::get('resize/{width}/{height}/{path}','ImageController@resize')
    ->where([
        'width' => '\d+',
        'height' => '\d+',
        'path' => '[\w\.]+',
    ]);
Route::get('fit/{width}/{height}/{path}','ImageController@fit')
    ->where([
        'width' => '\d+',
        'height' => '\d+',
        'path' => '[\w\.]+',
    ]);
Route::get('widen/{width}/{path}','ImageController@widen')
    ->where([
        'width' => '\d+',
        'path' => '[\w\.]+',
    ]);
Route::get('heighten/{height}/{path}','ImageController@heighten')
    ->where([
        'height' => '\d+',
        'path' => '[\w\.]+',
    ]);
Route::get('show/{path}','ImageController@show')->where('path','[\w\.]+');

