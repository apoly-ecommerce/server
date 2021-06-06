<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryGroupResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'icon' => $this->icon,
            'active' => $this->active,
            'order' => $this->order,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'background_image_url' => get_storage_file_url(optional($this->backgroundImage)->path, 'cover_thumb'),
            'cover_image_url' => get_storage_file_url(optional($this->coverImage)->path, 'cover_thumb'),
            'sub_groups' => $this->subGroups,
            'sub_groups_count' => $this->sub_groups_count,
        ];
    }
}
