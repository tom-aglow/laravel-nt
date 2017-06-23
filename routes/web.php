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



//ROUTES FOR USER SIDE OF THE SITE
//-----------------------------------
Route::group(['namespace' => 'Client'], function () {

//    routes for main pages

    Route::get('/', 'ClientController@index')
        ->name('client.client.index');
        // namespace . controller name . method

    Route::get('/article/{id}', 'ClientController@showArticle');
    Route::get('/about', 'ClientController@showAbout');
    Route::get('/contact', 'ClientController@showContact');


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




//ROUTES FOR ADMIN SIDE OF THE SITE
//-----------------------------------

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'AdminController@index');

    Route::group(['prefix' => 'article'], function () {
        Route::get('list', 'ArticleController@list');
        Route::get('add', 'ArticleController@add');
        Route::get('edit/{id}', 'ArticleController@edit');
        Route::get('delete/{id}', 'ArticleController@delete');
    });
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
