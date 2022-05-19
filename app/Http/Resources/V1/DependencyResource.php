<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class DependencyResource extends JsonResource
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
            // 'id'          => $this->id,
            'sup_user_id' => $this->sup_user_id,
            'sub_user_id' => $this->sub_user_id,
            // 'created_at'  => $this->created_at,
            // 'updated_at'  => $this->updated_at,
        ];
    }
}
