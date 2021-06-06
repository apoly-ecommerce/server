<?php

namespace App\Http\Requests\Validations;

use Illuminate\Support\Str;
use App\Http\Requests\Request;

class CreateManufacturerRequest extends Request
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
            'shop_id' => Request::user()->merchantId(),
            'slug' => Str::slug($this->input('name')),
        ]);

        return [
            'name' => 'bail|required|unique:manufacturers',
            'email' => 'email|max:255|nullable',
            'active' => 'required',
            'image' => 'mimes:jpg,jpeg,png,gif'
        ];
    }
}
