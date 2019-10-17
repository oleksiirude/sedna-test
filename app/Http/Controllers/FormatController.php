<?php

namespace App\Http\Controllers;

use App\Format;
use App\Http\Controllers\Response\FailureResponseController;
use App\Http\Controllers\Response\SuccessResponseController;
use App\Http\Requests\FormatRequest;

class FormatController extends Controller
{
    /**
     * @var Format $model
     */
    protected $model;
    
    /**
     * Create a new FormatController object.
     *
     * @param Format $model
     *
     * @return void
     */
    public function __construct(Format $format)
    {
        $this->model = $format;
    }
    
    /**
     * Delete format.
     *
     * @param FormatRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(FormatRequest $request)
    {
        $result = $this->model->deleteFormat($request->all());
        
        return $result ?
            SuccessResponseController::success('Format deleted', 200)
            : FailureResponseController::failure('Resource not found', 404);
    }
    
    /**
     * Create new format.
     *
     * @param FormatRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(FormatRequest $request)
    {
        $this->model->createFormat($request->all());
        
        return SuccessResponseController::success('Format added', 201);
    }
}
