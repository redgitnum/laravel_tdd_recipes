<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRecipeRequest extends FormRequest
{
    protected $redirect = '/dashboard/recipes';
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
            'title' => 'required|min:10',
            'request_id' => 'numeric',
            'overview' => 'required|min:30',
            'ingredients' => 'required|array',
            'paragraph_1' => 'required|min:50',
            'paragraph_2' => 'required_with:paragraph_3|min:50',
            'paragraph_3' => 'required_with:paragraph_4|min:50',
            'paragraph_4' => 'required_with:paragraph_5|min:50',
            'paragraph_5' => 'required_with:paragraph_6|min:50',
            'paragraph_6' => 'min:50',
            'images' => 'string'
        ];
    }
}
