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
Route::group(['namespace' => 'Client'], function () {

//    routes for main pages

    Route::get('/', 'ClientController@index')
        ->name('client.client.index');
        // namespace . controller name . method

    Route::get('/article/{slug}', 'ArticleController@showArticle')
        ->name('client.article.show')
        ->where('slug', '[\:0-9A-Za-z\-]+');
    Route::post('/article/{slug}', 'ArticleController@processComment')
        ->name('client.article.show')
        ->where('slug', '[\:0-9A-Za-z\-]+');

    Route::get('/about', 'ClientController@showAbout')
        ->name('client.about.show');


    Route::get('/contact', 'ClientController@showContact')
        ->name('client.contact.show');
    Route::post('/contact', 'ClientController@sendFeedback');

    Route::get('/404', 'ClientController@show404');


//    routes for login / logout

    Route::get('/signup', 'AuthController@signup')
        ->name('client.auth.signup');
    Route::post('/signup', 'AuthController@signupPost')
        ->name('client.auth.signupPost');

    Route::get('/login', 'AuthController@login')
        ->name('client.auth.login');
    Route::post('/login', 'AuthController@loginPost')
        ->name('client.auth.loginPost');

    Route::get('/logout', 'AuthController@logout')
        ->name('client.auth.logout');

});





