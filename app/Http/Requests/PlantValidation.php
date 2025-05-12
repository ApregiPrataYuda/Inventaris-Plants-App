<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlantValidation extends FormRequest
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
            'name' => 'required|string|min:3|max:100',
            'scientific_name' => 'nullable|string|max:100',
            'category_id' => 'required|exists:plant_categories,id_category',
            'location_id' => 'required|exists:locations,id_locations',
            'status' => 'required|in:healthy,needs_attention,damaged', // sesuaikan value status jika perlu
            'planting_date' => 'nullable|date',
            'notes' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Plant name is required.',
            'name.min' => 'Plant name must be at least 3 characters.',
            'name.max' => 'Plant name may not be greater than 100 characters.',
            'category_id.required' => 'Category is required.',
            'category_id.exists' => 'Selected category is invalid.',
            'location_id.required' => 'Location is required.',
            'location_id.exists' => 'Selected location is invalid.',
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be either alive, dead, or dormant.',
            'planting_date.date' => 'Planting date must be a valid date.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Image must be jpeg, png, jpg, or gif.',
            'image.max' => 'Image must not be more than 2MB.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => $this->name ? trim($this->name) : null,
            'scientific_name' => $this->scientific_name ? trim($this->scientific_name) : null,
            'notes' => $this->notes ? trim($this->notes) : null
        ]);
    }
}
