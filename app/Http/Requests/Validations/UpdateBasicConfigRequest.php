<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateBasicConfigRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Request::user()->merchantId() == Request::route('shop');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = Request::route('shop'); // Current model ID

        return [
            'name' => 'required',
            'legal_name' => 'required',
            'email' => 'required|email|max:255|composite_unique:shops,' . $id,
            'external_url' => 'nullable|url',
            'image' => 'mimes:jpg,jpeg,png,gif'
        ];
    }
}
