<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'user_type'   => $this->user_type,
            'email'       => $this->email,
            'name'        => $this->name,
            'middlename'  => $this->middlename,
            'lastname'    => $this->lastname,
            'phone'       => $this->phone,
            'mobile'      => $this->mobile,
            'img_profile' => $this->img_profile,
            'business'    => [
                'business_rfc'   => $this->business_rfc,
                'business_name'  => $this->business_name,
                'business_brief' => $this->business_brief,
                'address_street'    => $this->address_street,
                'address_number'    => $this->address_number,
                'address_suburb'    => $this->address_suburb,
                'address_zip'       => $this->address_zip,
                'address_reference' => $this->address_reference,
                'address_city'      => $this->address_city,
                'address_state'     => $this->address_state,
                'address_country'   => $this->address_country,
                'img_logo'          => $this->img_logo,
            ],

            
        ];
    }
}
