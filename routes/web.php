<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('/', function () {
    return 'FROM POST';
});





Route::group(['prefix' => 'test'], function () {
    Route::get('/1', 'TestController@index');

    Route::get('/2', function () {
        return view('test');
    });



    Route::any('/', 'TestController@index2');
});





Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'AdminController@index');
});





//Route::get('/user/{id?}', function ($id = null) {
//    return 'USER ' . $id;
//});

Route::get('/user/{id}/{name}', 'TestController@user')
    ->where([
        //see global pattern for id in RouteServicePrivider.php
        'name' => '[a-zA-Z\-\_]+'
    ])
    ->name('getUser');
