<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateValidation extends FormRequest
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
        'fullname' => 'required|string|min:3|max:150',
        'username' => 'required|min:3|max:50',
        'password' => 'nullable|string|min:5', // password nullable
        'passconf' => 'nullable|same:password', // passconf nullable juga
        'role_id' => 'required',
        'is_active' => 'required',
        'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:6048',

    ];
}

public function messages(): array
{
    return [
        'fullname.required' => 'The fullname field is required.',
        'fullname.string' => 'The fullname must be a valid string.',
        'fullname.min' => 'The fullname must be at least 3 characters.',
        'fullname.max' => 'The fullname may not be greater than 150 characters.',

        'username.required' => 'The username field is required.',
        'username.min' => 'The username must be at least 3 characters.',
        'username.max' => 'The username may not be greater than 50 characters.',

        // Hapus pesan 'required' karena password nullable
        'password.min' => 'The password must be at least 5 characters.',

        // Hapus 'required' karena passconf nullable
        'passconf.same' => 'The password confirmation does not match.',

        'role_id.required' => 'Select one role.',
        'is_active.required' => 'Select one status.',

        'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        'image.max' => 'The image may not be greater than 6MB.',
    ];
}

protected function prepareForValidation()
{
    $this->merge([
        'fullname' => $this->fullname ? trim($this->fullname) : null,
        'username' => $this->username ? trim($this->username) : null
    ]);
}

}
