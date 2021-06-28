<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'title_color' => $this->title_color,
            'sub_title_color' => $this->sub_title_color,
            'description' => $this->description,
            'description_color' => $this->description_color,
            'alt_color' => $this->alt_color,
            'text_position' => $this->text_position,
            'sub_title' => $this->sub_title,
            'link' => $this->link,
            'order' => $this->order,
            'feature_image' => get_storage_file_url(optional($this->featureImage)->path, 'medium'),
            'mobile_image' => get_storage_file_url(optional($this->mobileImage)->path, 'medium'),
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
