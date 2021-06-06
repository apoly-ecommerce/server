<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'category_sub_group_id' => $this->category_sub_group_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'active' => $this->active,
            'featured' => $this->featured,
            'order' => $this->order,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'products_count' => $this->products_count,
            'sub_group' => $this->subGroup,
            'cover_image_url' => get_storage_file_url(optional($this->coverImage)->path, 'medium'),
            'feature_image_url' => get_storage_file_url(optional($this->featureImage)->path, 'medium')
        ];
    }
}
