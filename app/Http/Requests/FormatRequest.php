<?php

namespace App\Http\Requests;

class FormatRequest extends APIFormRequest
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
            'format' => ['required', 'regex:/^(VHS|Blu-Ray|DVD)$/i']
        ];
    }
}
