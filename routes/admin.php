<?php

use Illuminate\Support\Facades\Route;

/**************************************
 *
 * Admin panel routes
 *
 **************************************/


Route::get('/', 'AdminController@index')
    ->name('admin.admin.index');


/*
 * Routes for articles
 */

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


/*
 *  Routes for comments
 */

Route::group(['prefix' => 'comment'], function () {
    Route::get('/', 'CommentController@list')
        ->name('admin.comment.list');
    Route::get('list', 'CommentController@list')
        ->name('admin.comment.list');
    Route::get('{id}/{action}', 'CommentController@action')
        ->name('admin.comment.action')
        ->where('action', '[a-z]+');;
});

/*
 *  Routes for tags
 */

Route::group(['prefix' => 'tag'], function () {
    Route::get('/', 'TagController@list')
        ->name('admin.tag.list');

    Route::post('update/{id}', 'TagController@update')
        ->name('admin.tag.update');

    Route::post('add', 'TagController@add')
        ->name('admin.tag.add');
});

/*
 *  Routes for login/logout
 */

Route::get('/login', 'AuthController@login')
    ->name('admin.auth.login');
Route::post('/login', 'AuthController@loginPost')
    ->name('admin.auth.loginPost');

Route::get('/logout', 'AuthController@logout')
    ->name('admin.auth.logout');
