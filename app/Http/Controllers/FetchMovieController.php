<?php

namespace App\Http\Controllers;

use App\Movie;

class FetchMovieController extends Controller
{
    public function getMovie($movieId)
    {
        $movie = Movie::find($movieId);
        
        $movie->actors;
        $movie->formats;
        
        return response()->json([
            'success' => true,
            'movie' => $movie
        ], 200);
    }
}
