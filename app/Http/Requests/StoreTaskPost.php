<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Rules\UserInCompany;

class StoreTaskPost extends FormRequest
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
            'status' => 'in:0,1,2',
            'users.*' => ['exists:users,id', 
                          'distinct', //check if user is part of company and user exists. 
                          Rule::exists('company_user', 'user_id')->where(function ($query) {
                            $query->where('company_id', Auth::user()->company_id);
                          })],
            'project_id' => [Rule::exists('projects', 'id')->where(function ($query) {
                            $query->where('company_id', Auth::user()->company_id);
                          })],
            'start_date' => 'date_format:"d-m-Y',
            'end_time' => 'date_format:"d-m-Y',
            'time_estimate' => 'date_format:H:i'
        ];
    }
}
