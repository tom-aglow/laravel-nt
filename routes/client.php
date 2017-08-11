<?php

use Illuminate\Support\Facades\Route;

/**************************************
 *
 * Client side routes
 *
 **************************************/



// namespace . controller name . method

//  ARTICLES
Route::get('/article/{slug}', 'ArticleController@showArticle')
    ->name('client.article.show')
    ->where('slug', '[\:0-9A-Za-z\-]+');
Route::post('/article/{slug}', 'ArticleController@processComment')
    ->name('client.article.show')
    ->where('slug', '[\:0-9A-Za-z\-]+');

//  TAGS
Route::name('client.client.listByTag')
    ->get('/tag/{tag}', 'ClientController@listByTag')
    ->where('tag', '[A-Za-z\-]+');


Route::get('/about', 'ClientController@showAbout')
    ->name('client.about.show');



Route::get('/contact', 'ClientController@showContact')
    ->name('client.contact.show');
Route::post('/contact', 'ClientController@sendFeedback');

Route::get('/404', 'ClientController@show404');


//  LOGIN / SIGNUP / LOGOUT

Route::post('/signup', 'AuthController@signupPost')
    ->name('client.auth.signupPost');

Route::get('/login', 'AuthController@login')
    ->name('client.auth.login');
Route::post('/login', 'AuthController@loginPost')
    ->name('client.auth.loginPost');

Route::get('/logout', 'AuthController@logout')
    ->name('client.auth.logout');


//  SOCIAL MEDIA LOGIN

Route::get('login/{provider}', 'AuthController@redirectToProvider')
    ->name('client.auth.provider')
    ->where('provider', '[a-z]+');
Route::get('login/{provider}/callback', 'AuthController@handleProviderCallback')
    ->where('provider', '[a-z]+');


//  FORUM
Route::get('/threads', 'ThreadController@index')
    ->name('client.threads.index');

Route::post('/threads', 'ThreadController@store');

Route::get('/threads/create', 'ThreadController@create')
    ->name('client.threads.create');

Route::get('/threads/{channel}', 'ThreadController@index')
    ->name('client.threads.channel');
Route::get('threads/{channel}/{thread}', 'ThreadController@show')
    ->name('client.threads.show');
Route::delete('threads/{channel}/{thread}', 'ThreadController@destroy')
    ->name('client.threads.delete');


Route::post('threads/{channel}/{thread}/replies', 'ReplyController@store');

Route::post('replies/{reply}/favourites', 'FavouriteReplyController@store')
    ->name('client.replies.favourite');
Route::delete('replies/{reply}/favourites', 'FavouriteReplyController@destroy')
    ->name('client.replies.unfavourite');

Route::patch('replies/{reply}', 'ReplyController@update')
    ->name('client.replies.update');
Route::delete('replies/{reply}', 'ReplyController@destroy')
    ->name('client.replies.delete');

Route::get('/profiles/{user}', 'ProfileController@show')
    ->name('client.profiles.show');

//  INDEX
Route::get('/', 'ClientController@home')
    ->name('client.client.index');

