<?php

namespace App\Http\Controllers\Movie;

use App\Movie;
use Validator;
use App\Http\Controllers\Response\FailureResponseController;
use App\Http\Controllers\Response\SuccessResponseController;

class FetchMovieController extends MovieController
{
    /**
     * Get movie by id.
     *
     * @param int $movieId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMovie($movieId)
    {
        $validator = Validator::make(['movie_id' => $movieId], [
            'movie_id' => 'required|integer'
        ]);
        if ($validator->fails())
            return FailureResponseController::failure($validator->errors()->first(), 400);
        
        $movie = $this->model->getMovie($movieId);
        $movie->formats = $this->getFormatsAsArray($movie);
        
        return SuccessResponseController::withFullMovieData($movie);
    }
    
    /**
     * Get all of the models from the database.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMovies()
    {
        $movies = $this->model->getAllMovies();
    
        return SuccessResponseController::withAllMovies($movies);
    }
    
    /**
     * Group and cast objects with formats to one array.
     *
     * @param Movie $movie
     *
     * @return array
     */
    private function getFormatsAsArray(Movie $movie)
    {
        foreach ($movie->formats as $format)
            $formats[] = $format->format;
        
        return isset($formats) ? $formats : null;
    }
}
