<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Hint:
// Auth::routes(); | only with artisan comand;

//routes for tag
Route::resource('tags', 'TagController', ['except' => 'create']);

//routes for categories except create method
Route::resource('categories', 'CategoryController', ['except' => 'create']);

//authentication [ login - logout ] Routes
Route::get('auth/login', ['as' => 'login' , 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('auth/login',['as' => 'login.post' , 'uses' => 'Auth\LoginController@login']);
Route::get('auth/logout',['as' => 'logout' , 'uses' => 'Auth\LoginController@logout']);

//route for comment
Route::post('comments/{post_id}', ['as' => 'comments.store', 'uses' => 'CommentsController@store']);
Route::get('comments/{id}/edit', ['as' => 'comments.edit', 'uses' => 'CommentsController@edit']);
Route::put('comments/{id}', ['as' => 'comments.update', 'uses' => 'CommentsController@update']);
Route::delete('comments/{id}', ['as' => 'comments.destroy', 'uses' => 'CommentsController@destroy']);
Route::get('comments/{id}/delete', ['as' => 'comments.delete', 'uses' => 'CommentsController@delete']);

//Registration routes
Route::get('auth/register', ['as' => 'register' , 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('auth/register', ['as' => 'register.post' , 'uses' => 'Auth\RegisterController@register']);

//reset password
Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);


Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
Route::get('blog', ['as' => 'blog.index', 'uses' => 'BlogController@getIndex']);
Route::get('contact', 'PagesController@getContact');
Route::post('contact', 'PagesController@postContact');
Route::get('about', 'PagesController@getAbout');
Route::get('/','PagesController@getIndex');

Route::resource('posts', 'PostController');
