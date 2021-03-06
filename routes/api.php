<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('json.response')->group(function() {

	Route::post('/login', ['uses' => 'Api\Auth\AuthController@login']);
	Route::post('/register', ['uses' => 'Api\Auth\AuthController@register']);

	Route::middleware('auth:api')->group(function() {
		
		Route::prefix('user')->group(function() {
			Route::patch('/changestatus/{user}', ['uses' => 'Api\User\UserController@changeStatus']);
		});

		Route::prefix('book')->group(function() {
			Route::get('/', ['uses' => 'Api\Book\BookController@all']);
			Route::get('/{book}', ['uses' => 'Api\Book\BookController@get']);
			Route::post('/', ['uses' => 'Api\Book\BookController@store']);
			Route::patch('/{book}', ['uses' => 'Api\Book\BookController@update']);
			Route::delete('/{book}', ['uses' => 'Api\Book\BookController@delete']);
		});

		Route::prefix('rent')->group(function() {
			Route::post('/', ['uses' => 'Api\Rent\RentController@request']);
			Route::patch('/proceed/{rent}', ['uses' => 'Api\Rent\RentController@proceed']);

		});

	});

});
