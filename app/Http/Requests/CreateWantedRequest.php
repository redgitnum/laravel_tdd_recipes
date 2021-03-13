<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateWantedRequest extends FormRequest
{
    protected $redirect = '/recipes/request';
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
            'title' => ['required', 'min:4', 'regex:/^[a-zA-Z]/'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title cannot be empty',
            'title.regex' => 'The title cannot contain numbers or special characters'
        ];
    }
}
