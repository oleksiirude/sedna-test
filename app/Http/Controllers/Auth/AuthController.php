<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Controllers\Response\SuccessResponseController;
use App\Http\Controllers\Response\FailureResponseController;

class AuthController extends Controller
{
    /**
     * Try to register new user.
     *
     * @param RegistrationRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegistrationRequest $request)
    {
        (new User())->registerNewUser($request->all());
        
        return SuccessResponseController::success('You have been successfully registered');
    }
    
    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (!$token = auth()->attempt($credentials))
            return FailureResponseController::failure("We don't have user with these credentials", 401);
        return SuccessResponseController::withToken($token);
    }
    
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
    
        return SuccessResponseController::success('You have been successfully registered');
    }
}
