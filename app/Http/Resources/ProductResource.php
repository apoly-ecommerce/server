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
                'id'   => $this->manufacturer->id,
                'name' => $this->manufacturer->name,
                'slug' => $this->manufacturer->slug
            ],
            'brand' => $this->brand,
            'name' => $this->name,
            'model_number' => $this->model_number,
            'mpn' => $this->mpn,
            'description' => $this->description,
            'min_price' => $this->min_price,
            'max_price' => $this->max_price,
            'slug' => $this->slug,
            'active' => $this->active,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'image' => get_storage_file_url(optional($this->featureImage)->path, 'cover_thumb'),
            'categories' => $this->categories
        ];
    }
}
