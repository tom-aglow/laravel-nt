<?php

use Illuminate\Support\Facades\Route;

/**************************************
 *
 * AdminCP routes
 *
 **************************************/


//Route::get('/', 'AdminController@index')
//    ->name('admin.admin.index');


/*
 * Routes for articles
 */

Route::resource('posts', 'PostController');


//Route::group(['prefix' => 'articles', 'middleware' => 'can:all,App\Models\Article'], function () {
//});
