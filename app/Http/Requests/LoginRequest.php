<?php

namespace App\Http\Requests;

class LoginRequest extends APIFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|min:5|max:100',
            'password' => 'required|string|min:6|max:40'
        ];
    }
}
