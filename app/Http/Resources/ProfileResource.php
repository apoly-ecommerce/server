<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'name' => $this->name,
            'nice_name' => $this->nice_name,
            'active' => $this->active,
            'description' => $this->description,
            'dob' => $this->dob,
            'role_name' => $this->role->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'last_visited_at' => $this->last_visited_at,
            'last_visited_from' => $this->last_visited_from,
            'read_announcements_at' => $this->read_announcements_at,
            'sex' => $this->sex,
            'shop_id' => $this->shop_id,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'image' => get_storage_file_url(optional($this->image)->path, 'medium'),
            'primary_address' => $this['primaryAddress']
        ];
    }
}