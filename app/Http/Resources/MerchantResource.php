<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MerchantResource extends JsonResource
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
            'role_id' => $this->role_id,
            'name' => $this->name,
            'nice_name' => $this->nice_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'active' => $this->active,
            'dob' => $this->dob,
            'sex' => $this->sex,
            'description' => $this->description,
            'owns' => [
                'id' => $this->owns->id,
                'name' => $this->owns->name,
                'image' => get_storage_file_url(optional($this->owns->image)->path, 'medium'),
                'deleted_at' => $this->owns->deleted_at,
            ],
            'role' => [
              'id' => $this->role->id,
              'shop_id' => $this->role->shop_id,
              'name' => $this->role->name,
              'level' => $this->role->level
            ],
            'image' => get_storage_file_url(optional($this->image)->path, 'medium'),
            'primaryAddress' => $this->primary_address,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
