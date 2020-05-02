<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserPost extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->route()->user->id)],
            'role_id' => ['required', 'exists:roles,id'],
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => 'The user role field is required.',
            'role_id.exists'  => 'The user role field is required.'
        ];
    }
}
