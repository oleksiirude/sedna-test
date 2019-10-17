<?php

namespace App\Http\Controllers\Movie;

use Illuminate\Http\Request;
use App\Http\Controllers\Response\SuccessResponseController;

class DeleteMovieController extends MovieController
{
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
        $this->model->deleteMovie($movieId);
        
        return SuccessResponseController::success('Movie has been deleted');
    }
}
