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

    Route::get('/article/{id}', 'ClientController@showArticle');
    // !!! DON'T FORGET ABOUT MASKS WHILE USING VARIABLES IN URI
    Route::get('/about', 'ClientController@showAbout');
    Route::get('/contact', 'ClientController@showContact');

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




//ROUTES FOR ADMIN SIDE OF THE SITE
//-----------------------------------

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
//    TODO add middleware Auth for the whole admin site

    Route::get('/', 'AdminController@index');

    //    routes for article

    Route::group(['prefix' => 'article'], function () {
        Route::get('/', 'ArticleController@list')
            ->name('admin.article.list');
        Route::get('list', 'ArticleController@list')
            ->name('admin.article.list');


        Route::get('add', 'ArticleController@add')
            ->name('admin.article.add');
        Route::post('add', 'ArticleController@addPost')
            ->name('admin.article.addPost');


        Route::get('edit/{id}', 'ArticleController@edit')
            ->name('admin.article.edit');
        Route::post('edit/{id}', 'ArticleController@editPost')
            ->name('admin.article.editPost');

        Route::get('delete/{id}', 'ArticleController@delete')
            ->name('admin.article.delete');
    });



    //    routes for login / logout

    Route::get('/login', 'AuthController@login')
        ->name('admin.auth.login');
    Route::post('/login', 'AuthController@loginPost')
        ->name('admin.auth.loginPost');

    Route::get('/logout', 'AuthController@logout')
        ->name('admin.auth.logout');

//    TODO make authorisation for admin side and change the author of the article when it is added or edited to current user
});





