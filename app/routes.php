<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::controller('main', 'MainController');
Route::controller('trivia', 'TriviaController');
Route::controller('user', 'UserController');
Route::controller('result', 'ResultController');
Route::controller('account', 'AccountController');
Route::controller('team', 'TeamController');

Route::get('/login', 'LoginController@getIndex');
Route::get('/logout', 'LoginController@getLogout');
Route::controller('/', 'LoginController');