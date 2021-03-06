<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateCategoryRequest extends Request
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
            'category_sub_group_id' => 'required|integer',
            'name'   => 'required',
            'slug'   => 'required|unique:categories',
            'image'  => 'mimes:jpg,jpeg,png',
            'active' => 'required'
        ];
    }
}
