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
Route::get('test', 'mainAQ@test');
Route::get('man', 'mainAQ@colladaBody');

// accupresure
Route::get('accu_json_req', 'mainAQ@Json_build_ACC_treatment');

Route::get('read', 'mainAQ@readJ');



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
