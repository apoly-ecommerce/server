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
            'id'            => $this->id,
            'shop_id'       => $this->shop_id,
            'role_id'       => $this->role_id,
            'name'          => $this->name,
            'nice_name'     => $this->nice_name,
            'dob'           => $this->dob,
            'sex'           => $this->sex,
            'description'   => $this->description,
            'active'        => $this->active,
            'email'         => $this->email,
            'merchant_user' => $this->merchantId(),
            'access_level'  => $this->accessLevel(),
            'special_role'  => isset($this->role) && $this->role->isSpecial() ? TRUE : FALSE,
            'status'        => 200
        ];
    }
}
