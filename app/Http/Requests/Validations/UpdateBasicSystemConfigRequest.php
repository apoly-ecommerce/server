<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateBasicSystemConfigRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Request::user()->isSuperAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'legal_name' => 'required',
            'email' =>  'required|email|max:255',
            'icon' => 'mimes:jpg,jpeg,png',
            'logo' => 'mimes:jpg,jpeg,png',
        ];
    }
}
