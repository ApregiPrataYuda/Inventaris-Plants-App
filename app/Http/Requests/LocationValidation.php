<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationValidation extends FormRequest
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
            'name_locations' => 'required|string|min:3|max:50'
        ];
    }
    
    public function messages(): array
    {
        return [
            'name_locations.required' => 'The category field is required.',
            'name_locations.string' => 'The category must be a valid string.',
            'name_locations.min' => 'The category must be at least 3 characters.',
            'name_locations.max' => 'The category may not be greater than 50 characters.'
        ];
    }
    
    protected function prepareForValidation()
    {
        $this->merge([
            'name_locations' => $this->name_locations ? trim($this->name_locations) : null
        ]);
    }
}
