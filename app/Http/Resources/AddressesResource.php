<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this['addressable_type'] == 'customer') {
            $addressable = new CustomerResource($this['addressable']);
        } else if ($this['addressable_type'] == 'user') {
            $addressable = new UserResource($this['addressable']);
        } else {
          $addressable = $this['addressable'];
        }

        return [
          'addressable_type' => $this['addressable_type'],
          'addressable' => $addressable,
          'addresses' => $this['addresses']
        ];
    }
}