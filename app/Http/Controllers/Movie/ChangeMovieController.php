<?php

namespace App\Http\Controllers\Movie;

use App\Http\Requests\ChangeTitleRequest;
use App\Http\Requests\ChangeSummaryRequest;
use App\Http\Requests\ChangeProductionYearRequest;
use App\Http\Controllers\Response\SuccessResponseController;

class ChangeMovieController extends MovieController
{
    /**
     * Change movie's title.
     *
     * @param ChangeTitleRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeTitle(ChangeTitleRequest $request)
    {
        $this->model->changeTitle($request->all());
        
        return SuccessResponseController::success('Title changed', 201);
    }
    
    /**
     * Change movie's summary.
     *
     * @param ChangeSummaryRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeSummary(ChangeSummaryRequest $request)
    {
        $this->model->changeSummary($request->all());
    
        return SuccessResponseController::success('Summary changed', 201);
    
    }
    
    /**
     * Change movie's production year.
     *
     * @param ChangeProductionYearRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeProductionYear(ChangeProductionYearRequest $request)
    {
        $this->model->changeProductionYear($request->all());
    
        return SuccessResponseController::success('Production year changed', 201);
    }
}
