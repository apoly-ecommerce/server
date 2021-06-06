<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateCategoryGroupRequest extends Request
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
            'name'   => 'required|unique:category_groups',
            'slug'   => 'required|unique:category_groups',
            'active' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    // public function messages()
    // {
    //     return [
    //         'name.required' => trans('validation.required', ['attribute' => 'name']),
    //         'name.unique' => trans('validation.unique', ['attribute' => 'name']),
    //         'slug.required' => trans('validation.required', ['attribute' => 'slug']),
    //         'slug.unique' => trans('validation.unique', ['attribute' => 'slug']),
    //         'active.required' => trans('validation.required', ['attribute' => 'status'])
    //     ];
    // }

}
