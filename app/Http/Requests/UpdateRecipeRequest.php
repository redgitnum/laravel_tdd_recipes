<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
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
            'title' => 'required|min:10|max:50',
            'overview' => 'required|min:30|max:150',
            'ingredients' => 'required|array',
            'ingredients.*' => 'required|min:3',
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
            'ingredients' => array_filter(array_map('trim', explode(',', $this->ingredients))),
        ]);
    }

    protected function passedValidation()
    {
        if(!$this->paragraph_2){
            $this->merge(['paragraph_2' => null]);
        }
        if(!$this->paragraph_3){
            $this->merge(['paragraph_3' => null]);
        }
        if(!$this->paragraph_4){
            $this->merge(['paragraph_4' => null]);
        }
        if(!$this->paragraph_5){
            $this->merge(['paragraph_5' => null]);
        }
        if(!$this->paragraph_6){
            $this->merge(['paragraph_6' => null]);
        }
    }
}
