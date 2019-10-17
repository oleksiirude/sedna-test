<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Http\Controllers\Response\SuccessResponseController;

class FetchMovieController extends Controller
{
    /**
     * @var Movie $model
     */
    protected $model;
    
    /**
     * Create a new FetchMovieController object.
     *
     * @param Movie $model
     *
     * @return void
     */
    public function __construct(Movie $model)
    {
        $this->model = $model;
    }
    
    /**
     * Get movie by id.
     *
     * @param int $movieId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMovie(int $movieId)
    {
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
        
        return $formats;
    }
}
