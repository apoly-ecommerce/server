<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ManufacturerResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'country_id' => $this->country_id,
            'email' => $this->email,
            'url' => $this->url,
            'phone' => $this->phone,
            'description' => $this->description,
            'active' => $this->active,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'country' => $this->country,
            'updated_at' => $this->updated_at,
            'products_count' => $this->products_count,
            'cover_image' => get_storage_file_url(optional($this->coverImage)->path, 'cover_thumb'),
            'logo_image' => get_storage_file_url(optional($this->logoImage)->path, 'cover_thumb'),
            'feature_image' => get_storage_file_url(optional($this->featureImage)->path, 'cover_thumb')
        ];
    }
}
