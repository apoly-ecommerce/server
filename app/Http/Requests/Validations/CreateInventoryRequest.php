<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateInventoryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->shop->canAddThisInventory($this->product_id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->user(); // Get current user
        Request::merge([
            'shop_id' => $user->merchantId(),
            'user_id' => $user->id
        ]);

        return [
            'title' => 'required',
            'sku' => 'required|unique:inventories,sku',
            'sale_price' => 'required|numeric|min:0',
            'offer_price' => 'required|numeric',
            'available_from' => 'nullable|date',
            'offer_start' => 'nullable|date|required_with:offer_price|after_or_equal:now',
            'offer_end' => 'nullable|date|required_with:offer_price|after:offer_start',
            'slug' => 'required|unique:inventories,slug'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'offer_start.required_with' => trans('validations.offer_start_required'),
            'offer_start.after_or_equal' => trans('validations.offer_start_after'),
            'offer_end.required_with' => trans('validations.offer_end_required'),
            'offer_end.after' => trans('validations.offer_end_after'),
        ];
    }
}