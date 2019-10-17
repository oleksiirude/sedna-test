<?php

namespace App\Http\Controllers\Movie;

use App\Movie;
use Lcobucci\JWT\Parser;
use App\Http\Controllers\TokenParseController;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Controllers\Response\SuccessResponseController;
use App\Http\Controllers\Response\FailureResponseController;

class CreateMovieController extends MovieController
{
    /**
     * @var $parser
     */
    protected $parser;
    
    /**
     * Create a new CreateMovieController object.
     *
     * @param Movie $model
     *
     * @return void
     */
    public function __construct(Movie $movie)
    {
        parent::__construct($movie);
        $this->parser = (new TokenParseController(new Parser()));
    }
    
    /**
     * Create new movie.
     *
     * @param CreateMovieRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateMovieRequest $request)
    {
        $params = $request->all();
        $userId = $this->parser->getIdFromToken($request->bearerToken());
        
        if (!$this->checkIfExists($params)) {
            $this->model->createNewMovie($request->all(), $userId);
            return SuccessResponseController::success('Movie created', 201);
        }
        
        return FailureResponseController::failure('This movie already exists', 404);
    }
    
    /**
     * Check if movie already exists.
     *
     * @param array $params
     *
     * @return boolean
     */
    protected function checkIfExists(array $params)
    {
        $existence = $this->model->checkIfExists($params);
       
        return $existence ? true : false;
    }
}
