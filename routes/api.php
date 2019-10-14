<?php

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

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::get('movie/{movie_id}', 'FetchMovieController@getMovie');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('logout', 'AuthController@logout');
});