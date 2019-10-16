<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;

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
        
        return ResponseController::responseSuccess("You have been successfully registered");
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
        
        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
        
        return response()->json([
            'success' => true,
            'access_token' => $token,
            'expires_in' => auth()->factory()->getTTL() * (int) config('jwt.ttl')
        ], 200);
    }
    
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
    
        return ResponseController::responseSuccess("You have been successfully logged out");
    }
}
