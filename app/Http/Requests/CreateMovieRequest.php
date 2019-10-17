<?php

namespace App\Http\Requests;

class CreateMovieRequest extends APIFormRequest
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
            'title' => ['required', 'max:100','regex:/^([-a-z_ 0-9])+$/i'],
            'summary' => ['nullable', 'max:300','regex:/[ -~]/'],
            'prod_year' => ['regex:/^\d{4}$/']
        ];
    }
}
