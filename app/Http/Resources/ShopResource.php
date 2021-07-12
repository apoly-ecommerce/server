<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
            'owner_id' => $this->owner_id,
            'name' => $this->name,
            'legal_name' => $this->legal_name,
            'slug' => $this->slug,
            'email' => $this->email,
            'description' => $this->description,
            'external_url' => $this->external_url,
            'active' => $this->active,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'owner' => $this->owner,
            'logo_image' => get_storage_file_url(optional($this->logoImage)->path, 'medium'),
            'cover_image' => get_storage_file_url(optional($this->coverImage)->path, 'cover_thumb'),
            'primaryAddress' => $this->primaryAddress,
            'config' => [
                'paymentMethods' => $this->config->paymentMethods,
                'support_phone' => $this->config->support_phone,
                'support_email' => $this->config->support_email,
                'updated_at' => $this->config->updated_at,
            ],
            'maintenance_mode' => $this->config->maintenance_mode
        ];
    }
}