<?php

namespace App\Http\Controllers\Movie;

use App\Movie;
use App\Http\Controllers\Controller;

abstract class MovieController extends Controller
{
    /**
     * @var Movie $model
     */
    protected $model;
    
    /**
     * Create a new FormatController object.
     *
     * @param Movie $model
     *
     * @return void
     */
    public function __construct(Movie $movie)
    {
        $this->model = $movie;
    }
}
