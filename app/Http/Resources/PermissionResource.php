<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
            'id'        => $this['id'],
            'module_id' => $this['module_id'],
            'name'      => $this['name'],
            'slug'      => $this['slug'],
            'pivot'     => [
                'role_id'       => $this['pivot']['role_id'],
                'permission_id' => $this['pivot']['permission_id'],
            ]
        ];
    }
}
