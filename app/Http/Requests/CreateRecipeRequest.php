<?php

namespace App\Http\Requests;

use App\Models\WantedRecipe;
use Illuminate\Foundation\Http\FormRequest;

class CreateRecipeRequest extends FormRequest
{
    protected $redirect = '/dashboard/recipes/create';
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
            'title' => 'required|min:10|max:50',
            'request_user_id' =>'nullable',
            'overview' => 'required|min:30|max:150',
            'ingredients' => 'required|array',
            'paragraph_1' => 'required|min:50|max:2000',
            'paragraph_2' => 'required_with:paragraph_3|min:50|max:2000',
            'paragraph_3' => 'required_with:paragraph_4|min:50|max:2000',
            'paragraph_4' => 'required_with:paragraph_5|min:50|max:2000',
            'paragraph_5' => 'required_with:paragraph_6|min:50|max:2000',
            'paragraph_6' => 'min:50',
            'images' => 'string'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'ingredients' => array_map('trim', explode(',', $this->ingredients)),
            'request_user_id' => WantedRecipe::find($this->request_id)->user_id
        ]);
    }
}
