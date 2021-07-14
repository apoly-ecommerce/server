<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateChatRoomRequest extends Request
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
        $rules = [];
        $rules['name'] = 'bail|required';

        $shop_id = Request::user()->merchantId();

        Request::merge(['created_by' => Request::user()->id]);

        if ($shop_id) {
            Request::merge(['shop_id' => $shop_id]);
        }

        return $rules;
    }
}
