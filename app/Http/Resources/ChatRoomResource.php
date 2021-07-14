<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatRoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'shop_id' => $this->shop_id,
            'name' => $this->name,
            'created_by' => $this->created_by,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'image' => get_storage_file_url(optional($this->image)->path, 'medium'),
            'users' => $this->users
        ];
    }
}
