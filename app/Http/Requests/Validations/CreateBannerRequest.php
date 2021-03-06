<?php

namespace App\Http\Requests\Validations;

use Illuminate\Foundation\Http\FormRequest;

class CreateBannerRequest extends FormRequest
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
            'title' => 'max:255',
            'group_id' => 'required',
            'description' => 'max:255',
            'images.*.feature' => 'required|mimes:jpg,jpeg,png,gif',
        ];
    }
}
