<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
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

        Request::merge(['creator_id' => Request::user()->id]);

        return [
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'role_id' => 'required',
            'dob' => 'nullable|date',
            'active' => 'required',
            'image' => 'mimes:jpeg,jpg,png'
        ];
    }

    /**
     * Get the errors messages for tje defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique' => trans('validation.register_email_unique'),
            'phone.unique' => trans('validation.register_phone_unique')
        ];
    }
}
