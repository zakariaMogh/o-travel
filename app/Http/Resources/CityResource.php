<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'name'  => $this->name ?? '',
            'name_ar'  => $this->name_ar ?? '',
            'latitude'  => $this->latitude ?? 0,
            'longitude'  => $this->longitude ?? 0,
        ];
    }
}
