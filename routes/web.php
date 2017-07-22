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

//    test
Route::get('/test3', 'TestController@getUsers');
Route::get('/testorm', 'TestController@testORM');
Route::get('/testrel', 'TestController@testRel');

Route::get('/uploader', 'TestController@uploaderGet');
Route::post('/uploader', 'TestController@uploaderPost');
Route::get('/uploaderDelete', 'TestController@uploaderDelete');
Route::get('/testcache', 'TestController@testCache');
Route::get('/testmail', 'TestController@testMail');

Route::get('/ajax', 'TestController@ajax')
    ->name('client.test.ajax');
Route::post('/ajax', 'TestController@ajaxPost');

//    laravel's staff

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//ROUTES FOR USER SIDE OF THE SITE
//-----------------------------------
//Route::group(['namespace' => 'Client'], function () {
//
//    //  INDEX
//
//
//
//});





