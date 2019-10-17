<?php

namespace App\Http\Middleware;

use App\Movie;
use Closure;
use Validator;
use Lcobucci\JWT\Parser;
use App\Http\Controllers\Response\FailureResponseController;

class CheckIfMovieOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required|integer'
        ]);
        if ($validator->fails())
            return FailureResponseController::failure($validator->errors()->first(), 400);
        
        $movieOwnerId = (new Movie)->getMovieOwnerId($request->get('movie_id'));
        $tokenUserId = ((new Parser)->parse($request->bearerToken()))->getClaim('sub');
        
        if (!$movieOwnerId)
            return FailureResponseController::failure('Empty set', 404);
        else if ($tokenUserId !== $movieOwnerId)
            return FailureResponseController::failure('Forbidden', 403);
        
        return $next($request);
    }
}