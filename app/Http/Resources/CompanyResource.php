<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'  => $this->id,
            'name'  => $this->name ?? '',
            'email'  => $this->email ?? '',
            'phone'  => $this->phone,
            'country_code'  => $this->country_code,
            'image' => $this->image_url,
            'state'  => $this->state,
            'checked'  => $this->checked,
            'facebook'  => $this->facebook ?? '',
            'whatsapp'  => $this->whatsapp ?? '',
            'snapchat'  => $this->snapchat ?? '',
            'instagram'  => $this->instagram ?? '',
            'twitter'  => $this->twitter ?? '',
            'rate'  => $this->rate,
            'latitude'  => $this->latitude ?? 0,
            'longitude'  => $this->longitude ?? 0,
            'address'  => $this->address ?? '',
            'description'  => $this->description ?? '',
            'trade_register'  => $this->when($this->trade_register,$this->trade_register_url),

            $this->mergeWhen(auth('company')->check() && auth('company')->id() === $this->id, [
                'wallet' => $this->wallet,
            ]),
            'domain'  => new DomainResource($this->whenLoaded('domain')),
            'city'  => new CityResource($this->whenLoaded('city')),

        ];
    }
}
