<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'link' => $this->link,
            'link_label' => $this->link_label,
            'bg_color' => $this->bg_color,
            'group_id' => $this->group_id,
            'columns' => $this->columns,
            'order' => $this->order,
            'group' => $this->group,
            'feature_image' => get_storage_file_url(optional($this->featureImage)->path, 'medium'),
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
