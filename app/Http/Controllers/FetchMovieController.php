<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Http\Requests\MovieRequest;

class FetchMovieController extends Controller
{
    /**
     * @var Movie
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
     * @param MovieRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMovie(MovieRequest $request)
    {
        $movie = $this->model->getMovie($request->get('id'));
        
        return response()->json([
            'success' => true,
            'movie_id' => $movie->id,
            'title' => $movie->title,
            'summary' => $movie->summary,
            'actors' => $movie->actors,
            'available_formats' => $this->getFormatsAsArray($movie)
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
    
    /**
     * Group and cast objects to one array.
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
