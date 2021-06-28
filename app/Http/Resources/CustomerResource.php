<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
          'name' => $this->name,
          'nice_name' => $this->nice_name,
          'email' => $this->email,
          'dob' => $this->dob,
          'sex' => $this->sex,
          'description' => $this->description,
          'last_visited_at' => $this->last_visited_at,
          'last_visited_from' => $this->last_visited_from,
          'active' => $this->active,
          'orders_count' => $this->orders_count,
          'image' => get_storage_file_url(optional($this->image)->path, 'medium'),
          'primaryAddress' => $this->primaryAddress,
          'latest_orders' => $this->latest_orders,
          'total_spent' => \App\Helpers\Statistics::total_spent($this->id),
          'addresses' => $this->addresses,
          'deleted_at' => $this->deleted_at,
          'created_at' => $this->created_at,
          'updated_at' => $this->updated_at,
        ];
    }
}
