<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'sku'         => $this->sku,
            'code'        => $this->code,
            'description' => $this->description,
            'price'       => $this->price,
            'category'    => $this->category,
            'exist'       => $this->exist,
            'visible'     => $this->visible,
        ];
    }
}