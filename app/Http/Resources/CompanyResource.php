<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'id'  => $this->id,
            'name'  => $this->name,
            'email'  => $this->email,
            'phone'  => $this->phone,
            'country_code'  => $this->country_code,
            'image' => $this->image_url,
            'state'  => $this->state,
            'checked'  => $this->checked,
            'facebook'  => $this->facebook,
            'whatsapp'  => $this->whatsapp,
            'snapchat'  => $this->snapchat,
            'instagram'  => $this->instagram,
            'twitter'  => $this->twitter,
            'rate'  => $this->rate,
            'latitude'  => $this->latitude,
            'longitude'  => $this->longitude,
            'address'  => $this->address,
            'description'  => $this->description,

            $this->mergeWhen(auth('company')->check(), [
                'wallet' => $this->wallet,
            ]),

        ];
    }
}
