<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'full_name' => $this->full_name,
            'capital' => $this->capital,
            'currency' => $this->currency,
            'timezone' => $this->timezone,
            'calling_code' => $this->calling_code,
            'active' => $this->active,
            'states_count' => $this->states_count,
            'states' => $this->states
        ];
    }
}
