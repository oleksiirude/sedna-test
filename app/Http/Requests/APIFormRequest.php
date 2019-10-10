<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class APIFormRequest extends FormRequest
{
    /**
     * Override origin method of Illuminate\Foundation\Http\FormRequest class to return response in JSON.
     *
     * @param Validator $validator
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $jsonResponse = response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
        
        throw new HttpResponseException($jsonResponse);
    }
}
