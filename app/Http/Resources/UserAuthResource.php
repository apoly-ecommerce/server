<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthResource extends JsonResource
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
            'role_id' => $this->role_id,
            'name' => $this->name,
            'nice_name' => $this->nice_name,
            'active' => $this->active,
            'merchant_user' => $this->merchantId(),
            'is_from_platform' => $this->isFromPlatform(),
            'access_level'  => $this->accessLevel(),
            'special_role'  => isset($this->role) && $this->role->isSpecial() ? TRUE : FALSE,
            'role' => [
                'id' => $this->role->id,
                'shop_id' => $this->role->shop_id,
                'name' => $this->role->name,
                'level' => $this->role->level
            ],
            'permissions' => $this->role->permissions,
            'image' => get_storage_file_url(optional($this->image)->path, 'medium'),
        ];
    }
}
