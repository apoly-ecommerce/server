<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategorySubGroupResource extends JsonResource
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
            'group' => $this->group,
            'name'  => $this->name,
            'slug'  => $this->slug,
            'description' => $this->description,
            'active' => $this->active,
            'order' => $this->order,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'cover_image' => get_storage_file_url(optional($this->coverImage)->path, 'cover_thumb'),
            'categories_count' => $this->categories_count,
            'categories' => $this->categories
        ];
    }
}
