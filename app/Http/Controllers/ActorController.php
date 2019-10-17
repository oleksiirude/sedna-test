<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Http\Controllers\Response\FailureResponseController;
use App\Http\Controllers\Response\SuccessResponseController;
use App\Http\Requests\ActorCreateRequest;
use App\Http\Requests\ActorDeleteRequest;

class ActorController extends Controller
{
    /**
     * @var Actor $model
     */
    protected $model;
    
    /**
     * Create a new FormatController object.
     *
     * @param Actor $model
     *
     * @return void
     */
    public function __construct(Actor $actor)
    {
        $this->model = $actor;
    }
    
    public function create(ActorCreateRequest $request)
    {
        if (!$this->model->createActor($request->all()))
            return FailureResponseController::failure('This actor already exists in movie', 200);
        
        return SuccessResponseController::success('Actor created', 201);
    }
    
    public function delete(ActorDeleteRequest $request)
    {
        if(!$this->model->deleteActorFromPivotTable($request->all()))
            return FailureResponseController::failure('Resource not found', 404);
        
        $this->model->checkIfPresentInMovies($request->get('actor_id'));
        return SuccessResponseController::success('Actor deleted', 200);
    }
}
