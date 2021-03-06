<?php

namespace App\Http\Controllers\Movie;

use App\Actor;
use App\Http\Requests\SearchRequest;
use App\Http\Controllers\Response\FailureResponseController;
use App\Http\Controllers\Response\SuccessResponseController;

class SearchMovieController extends MovieController
{
    /**
     * Manage movie search by name or title.
     *
     * @param SearchRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(SearchRequest $request)
    {
        $search = $request->all();
        
        if ($search['by'] === 'title')
            return $this->searchMovieByTitle($search['query']);
        return $this->searchMovieByActorName($search['query']);
    }
    
    /**
     * Search movie by title.
     *
     * @param string $title
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function searchMovieByTitle(string $title)
    {
        $movie = $this->model->searchMovieByTitle($title);
    
        return $movie ?
            SuccessResponseController::withShortMovieData($movie)
            : FailureResponseController::failure('Empty set', 404);
    }
    
    /**
     * Search movie by actor's name.
     *
     * @param string $name
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function searchMovieByActorName(string $name)
    {
        $movie = (new Actor())->searchMovieByActorName($name);
        
        return $movie ?
            SuccessResponseController::withShortMovieData($movie)
            : FailureResponseController::failure('Empty set', 404);
            
    }
}
