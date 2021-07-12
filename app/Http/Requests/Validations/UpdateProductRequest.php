<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateProductRequest extends Request
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
        $id = Request::segment(count(Request::segments())); // Current model ID.

        return [
            'category_list' => 'required',
            'name' => 'required|composite_unique:products, '.$id,
            'description' => 'required',
            'active' => 'required',
            'image' => 'mimes:jpg,jpeg,png,gif',
        ];
    }

    public function messages()
    {
        return [
            'name.composite_unique' => trans('validation.field_exists', ['attribute' => 'name'])
        ];
    }
}
