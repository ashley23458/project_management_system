<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Rules\UserInCompany;

class UpdateCompanyPost extends FormRequest
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
            'name' =>  ['required', 'string', 'max:255', Rule::unique('companies')->ignore($this->route()->company->id)],
            'user_id' => ['required', 'exists:users,id', 'distinct', //check if user is part of company and user exists. 
                          Rule::exists('company_user', 'user_id')->where(function ($query) {
                            $query->where('company_id', Auth::user()->company_id);
                          })],
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'The user field is required.',
            'user_id.exists'  => 'The user field is required.'
        ];
    }
}
