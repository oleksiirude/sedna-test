<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Response\SuccessResponseController;

class DeleteMovieController extends Controller
{
    /**
     * @var Movie $model
     */
    protected $model;
    
    /**
     * Create a new DeleteMovieController object.
     *
     * @param Movie $model
     *
     * @return void
     */
    public function __construct(Movie $movie)
    {
        $this->model = $movie;
    }
    
    /**
     * Delete movie.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $movieId = $request->get('movie_id');
        $this->model->where('id', '=', $movieId)->delete();
        
        return SuccessResponseController::success('Movie has been deleted');
    }
}
