<?php

namespace App\Http\Controllers;

use App\Movie;

class FetchMovieController extends Controller
{
    private $model;
    
    /**
     * Create a new FetchMovieController object.
     *
     * @param  Movie
     * @return void
     */
    public function __construct(Movie $model)
    {
        $this->model = $model;
    }
    
    /**
     * Get movie by id.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMovie($movieId)
    {
        $movie = $this->model->getMovie($movieId);
        
        return response()->json([
            'success' => true,
            'movie_id' => $movie->id,
            'title' => $movie->title,
            'summary' => $movie->summary,
            'actors' => $movie->actors,
            'available_formats' => $movie->formats
        ], 200);
    }
    
    /**
     * Get all of the models from the database.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMovies()
    {
        $movies = $this->model->getAllMovies();
    
        return response()->json([
            'success' => true,
            'movies_count' => count($movies),
            'movies' => $movies
        ], 200);
    }
}
