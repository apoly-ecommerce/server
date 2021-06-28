<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateAddressRequest extends Request
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
            'address_line_1' => 'required',
            'zip_code' => 'required',
            'country_id' => 'required|integer'
        ];
    }
}
