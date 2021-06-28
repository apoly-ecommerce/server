<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'manufacturer' => [
                'id'   => $this->manufacturer->id ?? null,
                'name' => $this->manufacturer->name ?? null,
                'slug' => $this->manufacturer->slug ?? null
            ],
            'brand' => $this->brand,
            'name' => $this->name,
            'model_number' => $this->model_number,
            'mpn' => $this->mpn,
            'detail_information' => $this->detail_information,
            'description' => $this->description,
            'promotional_price' => $this->promotional_price,
            'original_price' => $this->original_price,
            'requires_shipping' => $this->requires_shipping,
            'slug' => $this->slug,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'warranty_period' => $this->warranty_period,
            'warranty_form' => $this->warranty_form,
            'warranty_place' => $this->warranty_place,
            'percent_refund' => $this->percent_refund,
            'return_time' => $this->return_time,
            'allow_inspection' => $this->allow_inspection,
            'active' => $this->active,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'image' => get_storage_file_url(optional($this->featureImage)->path, 'cover_thumb'),
            'categories' => $this->categories,
            'media_products' => $this->mediaProducts
        ];
    }
}
