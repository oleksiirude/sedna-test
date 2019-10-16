<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;

class DeleteMovieController extends Controller
{
    public function delete(MovieRequest $request)
    {
        return response()->json([
            'ok' => true
        ]);
    }
}
