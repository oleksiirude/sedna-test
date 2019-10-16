<?php

namespace App\Http\Controllers;

use App\Movie;

class ResponseController extends Controller
{
    /**
     * Response with success and 200 status code.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function responseSuccess(string $message)
    {
        return response()->json([
            'success' => true,
            'message' => $message
        ], 200);
    }
    
    /**
     * Response with empty set and 404 status code.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function responseWithEmptySet()
    {
        return response()->json([
            'success' => false,
            'data' => 'Empty set'
        ], 404);
    }
    
    /**
     * Response with movie data and 200 status code.
     *
     * @param Movie $movie
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function responseWithMovieData($movie)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $movie->id,
                'title' => $movie->title
            ]
        ], 200);
    }
    
    /**
     * Response with forbid and 403 status code.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function responseForbidden()
    {
        return response()->json([
            'success' => false,
            'message' => 'Forbidden'
        ], 403);
    }
}
