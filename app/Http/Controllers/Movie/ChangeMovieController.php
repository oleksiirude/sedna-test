<?php

namespace App\Http\Controllers\Movie;

use App\Http\Requests\ChangeTitleRequest;
use App\Http\Requests\ChangeSummaryRequest;
use App\Http\Requests\ChangeProductionYearRequest;
use App\Http\Controllers\Response\SuccessResponseController;

class ChangeMovieController extends MovieController
{
    public function changeTitle(ChangeTitleRequest $request)
    {
        $this->model->where([
            'id' => $request->get('movie_id')
        ])->update([
            'title' => $request->get('title')
        ]);
        
        return SuccessResponseController::success('Title changed', 201);
    }
    
    public function changeSummary(ChangeSummaryRequest $request)
    {
        $this->model->where([
            'id' => $request->get('movie_id')
        ])->update([
            'summary' => $request->get('summary')
        ]);
    
        return SuccessResponseController::success('Summary changed', 201);
    
    }
    
    public function changeProductionYear(ChangeProductionYearRequest $request)
    {
        $this->model->where([
            'id' => $request->get('movie_id')
        ])->update([
            'prod_year' => $request->get('prod_year')
        ]);
    
        return SuccessResponseController::success('Production year changed', 201);
    }
}
