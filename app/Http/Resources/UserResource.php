<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'shop_id' => $this->shop_id,
            'role_id' => $this->role_id,
            'name' => $this->name,
            'nice_name' => $this->nice_name,
            'dob' => $this->dob,
            'sex' => $this->sex,
            'description' => $this->description,
            'active' => $this->active,
            'phone' => $this->phone,
            'email' => $this->email,
            'access_level'  => $this->accessLevel(),
            'special_role'  => isset($this->role) && $this->role->isSpecial() ? TRUE : FALSE,
            'role' => [
              'id' => $this->role->id,
              'shop_id' => $this->role->shop_id,
              'name' => $this->role->name,
              'level' => $this->role->level
            ],
            'image' => get_storage_file_url(optional($this->image)->path, 'medium'),
            'primaryAddress' => $this->primaryAddress,
            'shop' => $this->shop,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
