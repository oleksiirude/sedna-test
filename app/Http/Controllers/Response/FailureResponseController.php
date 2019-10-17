<?php

namespace App\Http\Controllers\Response;

class FailureResponseController
{
    /**
     * Response with message.
     *
     * @param string $message
     * @param int $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function failure(string $message, int $status = 401)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $status);
    }
}
