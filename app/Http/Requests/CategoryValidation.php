<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

     public function rules(): array
    {
        return [
            'name_category' => 'required|string|min:3|max:50'
        ];
    }
    
    public function messages(): array
    {
        return [
            'name_category.required' => 'The category field is required.',
            'name_category.string' => 'The category must be a valid string.',
            'name_category.min' => 'The category must be at least 3 characters.',
            'name_category.max' => 'The category may not be greater than 50 characters.'
        ];
    }
    
    protected function prepareForValidation()
    {
        $this->merge([
            'name_category' => $this->name_category ? trim($this->name_category) : null
        ]);
    }
}
