<?php

namespace App\Http\Resources;

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
            'id'  => $this->id,
            'name'  => $this->name,
            'email'  => $this->email,
            'phone'  => $this->phone,
            'country_code'  => $this->country_code,
            'image' => $this->image_url,
            'state'  => $this->state,

            $this->mergeWhen(auth('user')->check(), [
                'wallet' => $this->wallet,
            ]),

        ];
    }
}