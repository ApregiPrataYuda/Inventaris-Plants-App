<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddValidation extends FormRequest
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
                'fullname' => 'required|string|min:3|max:100',
                'username' => 'required|string|max:100',
                'password' => 'required|string|min:5',
                'passconf' => 'same:password',
                'role_id' => 'required',
                'is_active' => 'required',
            ];
        }


     public function messages(): array
    {
        return [
            'fullname.required' => 'The fullname field is required.',
            'fullname.string' => 'The fullname must be a valid string.',
            'fullname.min' => 'The fullname must be at least 3 characters.',
            'fullname.max' => 'The fullname may not be greater than 100 characters.',

            'username.required' => 'The username field is required.',
            'username.min' => 'The username must be at least 3 characters.',
            'username.max' => 'The username may not be greater than 50 characters.',

            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 5 characters.',

           'passconf.required' => 'The password confirmation field is required.',
           'passconf.same' => 'The password confirmation does not match.',

           'role_id.required' => 'Select one role.',
           'is_active.required' => 'Select one status.',

        //    'image.image'       => 'The uploaded file must be an image.',
        //    'image.mimes'       => 'The image must be a file of type: jpeg, png, jpg, gif.',
        //    'image.max'         => 'The image may not be greater than 2MB.',


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
