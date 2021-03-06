<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\UserInCompany;
use Illuminate\Support\Facades\Auth;

class StoreProjectPost extends FormRequest
{
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
            'title' => 'required|string|max:255',
            'description' => 'max:255',
            'users.*' => ['exists:users,id',
                          'distinct', //check if user is part of company and user exists.
                          Rule::exists('company_user', 'user_id')->where(function ($query) {
                            $query->where('company_id', Auth::user()->company_id);
                          })]
        ];
    }

    public function messages()
    {
        return [
            'users.*'  => 'Invalid user(s) selected.'
        ];
    }
}
