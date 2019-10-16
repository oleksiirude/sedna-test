<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ResponseController;
use App\Movie;
use Closure;
use Lcobucci\JWT\Parser;

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
        $token = $request->bearerToken();
        $tokenUserId = ((new Parser)->parse($token))->getClaim('sub');
        $movieOwnerId = (new Movie)->getMovieOwnerId($request->get('id'));
     
        if ($tokenUserId !== $movieOwnerId)
            return ResponseController::responseForbidden();
        
        return $next($request);
    }
}
