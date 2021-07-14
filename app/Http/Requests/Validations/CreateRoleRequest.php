<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateRoleRequest extends Request
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
        $rules = [];
        $rules['name'] = 'bail|required';

        $shop_id = Request::user()->merchantId(); // Get current user's shop_id

        if ($shop_id) {
            Request::merge(['shop_id' => $shop_id]); // Set merchant related info
        } else {
            $rules['public'] = 'required';
        }

        if (Request::user()->accessLevel()) {
            $rules['level'] = 'nullable|integer|between:'.Request::user()->accessLevel().', '.(99);
        }

        if (Request::input('level') && !Request::user()->accessLevel()) {
            Request::replace(['level' => null]); // Reset the level
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() : array
    {
        return [
            'name.unique'     => trans('validation.role_name_unique'),
            'name.require'    => trans('validation.role_name_required'),
            'public.required' => trans('validation.role_type_required')
        ];
    }
}