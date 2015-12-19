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

Route::get('/', 'mainAQ@index');

//Route::get('home', 'HomeController@index');
Route::get('home', 'mainAQ@index');
Route::get('body', 'mainAQ@body');
Route::get('lab', 'mainAQ@lab');
Route::get('man', 'mainAQ@colladaBody');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
