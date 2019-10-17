<?php

namespace App\Http\Requests;

class ActorCreateRequest extends APIFormRequest
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
            'first_name' => ['max:100', "regex:/^[a-z ,.'-]+$/i"],
            'last_name' => ['max:100', "regex:/^[a-z ,.'-]+$/i"]
        ];
    }
}
