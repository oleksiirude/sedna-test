<?php

namespace App\Http\Requests;


class SearchRequest extends APIFormRequest
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
            'by' => ['required', 'regex:/^(name|title)$/'],
            'query' => ['required', 'regex:/^([-a-z_ 0-9])+$/i']
        ];
    }
}
