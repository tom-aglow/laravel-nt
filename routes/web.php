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

Route::group(['namespace' => 'Client'], function () {
    Route::get('/', 'ClientController@index');
    Route::get('/article/{id}', 'ClientController@showArticle');
    Route::get('/about', 'ClientController@showAbout');
    Route::get('/contact', 'ClientController@showContact');

});









Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'AdminController@index');

    Route::group(['prefix' => 'article'], function () {
        Route::get('list', 'ArticleController@list');
        Route::get('add', 'ArticleController@add');
        Route::get('edit/{id}', 'ArticleController@edit');
        Route::get('delete/{id}', 'ArticleController@delete');
    });
});



