<?php

namespace App\Http\Controllers\Response;

use App\Movie;
use Illuminate\Database\Eloquent\Collection;

class SuccessResponseController
{
    /**
     * Response with message.
     *
     * @param string $message
     * @param int $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success(string $message, int $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message
        ], $status);
    }
    
    /**
     * Response with fresh jwt token.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function withToken(string $token)
    {
        return response()->json([
            'success' => true,
            'access_token' => $token,
            'expires_in' => auth()->factory()->getTTL() * (int)config('jwt.ttl')
        ], 200);
    }
    
    /**
     * Response with short movie data.
     *
     * @param Movie $movie
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function withShortMovieData(Movie $movie)
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
     * Response with short movie data.
     *
     * @param Movie $movie
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function withFullMovieData(Movie $movie)
    {
        return response()->json([
            'success' => true,
            'movie_id' => $movie->id,
            'title' => $movie->title,
            'summary' => $movie->summary,
            'actors' => $movie->actors,
            'available_formats' => $movie->formats
        ], 200);
    }
    
    /**
     * Response with short movie data.
     *
     * @param Collection $movie
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function withAllMovies(Collection $movies)
    {
        return response()->json([
            'success' => true,
            'movies_count' => count($movies),
            'movies' => $movies
        ], 200);
    }
}
