<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{

    protected $redirect = '/recipes';
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
            'query' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'query.min' => 'Minimum 3 characters required',
            'query.required' => 'Query is required',
        ];
    }
}
