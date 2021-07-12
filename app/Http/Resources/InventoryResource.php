<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'shop_id' => $this->shop_id,
            'title' => $this->title,
            'product_id' => $this->product_id,
            'sku' => $this->sku,
            'condition' => $this->condition,
            'condition_note' => $this->condition_note,
            'description' => $this->description,
            'stock_quantity' => $this->stock_quantity,
            'user_id' => $this->user_id,
            'purchase_price' => $this->purchase_price,
            'sale_price' => $this->sale_price,
            'offer_price' => $this->offer_price,
            'offer_start' => $this->offer_start,
            'offer_end' => $this->offer_end,
            'available_from' => $this->available_from,
            'min_order_quantity' => $this->min_order_quantity,
            'slug' => $this->slug,
            'linked_items' => unserialize($this->linked_items),
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'active' => $this->active,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'product' => [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'brand' => $this->product->brand,
                'manufacturer' => $this->product->manufacturer,
                'model_number' => $this->product->model_number,
                'image' => get_storage_file_url(optional($this->product->image)->path, 'medium')
            ],
        ];
    }
}