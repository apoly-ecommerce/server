<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateProductRequest extends Request
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
        Request::merge([
            'shop_id' => $this->user()->merchantId(),
            'slug' => convert_to_slug_string($this->input('name')),
        ]); // Set shop_id and slug

        return [
            'category_list' => 'required',
            'name' => 'required|unique:products',
            'description' => 'required',
            'active' => 'required',
            'promotional_price' => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:' . $this->promotional_price ?? 0,
            'image' => 'mimes:jpg,png,jpeg,gif'
        ];
    }
}