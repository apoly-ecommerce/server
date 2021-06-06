<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class AuthUserLoginRequest extends Request
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
    public function rules() : array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ];
    }

    /**
     * Format the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages() : array
    {
        return [
            'email.required'    => trans('auth.request.email_required'),
            'email.email'       => trans('auth.request.email_email'),
            'password.required' => trans('auth.request.password_required'),
            'password.min'      => trans('auth.request.password_min')
        ];
    }
}
