<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',"HomeController@index");

Route::resource('task', 'TaskController',['only' => ['index','store','destroy']]);
// For now we only need to get all users and categories so no need for the other routes
Route::resource('user', 'UserController',['only' => ['index']]);
Route::resource('category', 'CategoryController',['only' => ['index']]);
