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

Route::get('movies', 'Movie\FetchMovieController@getMovies');
Route::get('movies/search', 'Movie\SearchMovieController@search');
Route::get('movies/{movieId}', 'Movie\FetchMovieController@getMovie');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('movies', 'Movie\CreateMovieController@create');
    Route::group(['middleware' => 'owner'], function () {
        Route::patch('movies/title', 'Movie\ChangeMovieController@changeTitle');
        Route::patch('movies/summary', 'Movie\ChangeMovieController@changeSummary');
        Route::patch('movies/prod_year', 'Movie\ChangeMovieController@changeProductionYear');
        Route::delete('movies', 'Movie\DeleteMovieController@delete');
        Route::patch('movies/actors', 'ActorController@create');
        Route::delete('movies/actors', 'ActorController@delete');
        Route::patch('movies/formats', 'FormatController@create');
        Route::delete('movies/formats', 'FormatController@delete');
    });
    Route::post('logout', 'AuthController@logout');
});