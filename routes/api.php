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

Route::get('movies', 'FetchMovieController@getMovies');
Route::get('movies/search', 'SearchMovieController@search');
Route::get('movies/{movieId}', 'FetchMovieController@getMovie');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('movies', 'AddMovieController@create');
    Route::group(['middleware' => 'owner'], function () {
        Route::patch('movies', 'ChangeMovieController@change');
        Route::delete('movies', 'DeleteMovieController@delete');
        Route::patch('movies/actors', 'ActorController@create');
        Route::delete('movies/actors', 'ActorController@delete');
        Route::patch('movies/formats', 'FormatController@create');
        Route::delete('movies/formats', 'FormatController@delete');
    });
    Route::post('logout', 'AuthController@logout');
});