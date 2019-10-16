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
Route::post('logout', 'AuthController@logout')->middleware('auth.jwt');

Route::get('movies', 'FetchMovieController@getMovies');
Route::get('movies/movie', 'FetchMovieController@getMovie');
Route::get('movies/search', 'SearchMovieController@search');

Route::group(['middleware' => ['auth.jwt', 'owner']], function () {
    Route::delete('movies/movie', 'DeleteMovieController@delete');
});