<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'id'          => $this->id,
            'shop_id'     => $this->shop_id,
            'name'        => $this->name,
            'description' => $this->description,
            'public'      => $this->public,
            'level'       => $this->level,
            'deleted_at'  => $this->deleted_at,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at
        ];
    }
}
