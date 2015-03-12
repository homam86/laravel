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


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'meal' => 'MealController',
	'menu' => 'MenuController',
	'order' => 'OrderController',
]);

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::controller('meal', 'MealController');
Route::controller('admin', 'AdminController');


//Route::get('meal', function()
//{
//    return View::make('meal.index');
//});
