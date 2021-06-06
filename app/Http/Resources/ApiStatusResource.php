<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiStatusResource extends JsonResource
{

    /**
     * Status code default
     *
     * @var int
     */
    protected $statusCode = 200;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        return ['data' => $this->resource];
    }

    /**
     * Set status code.
     *
     * @param int $statusCode
     *
     * @return StatusResource
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param \Illuminate\Http\Request
     * @param \Illuminate\Http\Response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->setStatusCode($this->statusCode);
    }
}