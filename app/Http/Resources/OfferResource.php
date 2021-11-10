<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'price'  => $this->price,
            'description'  => $this->description,
            'rate'  => $this->rate,
            'date'  => $this->date,
            'state'  => $this->state,
            'published_at'  => $this->published_at,
            'images'  => ImageResource::collection($this->whenLoaded('images')),
            'category'  => new CategoryResource($this->whenLoaded('category')),
            'company'  => new CompanyResource($this->whenLoaded('company')),
            'countries'  =>  CountryResource::collection($this->whenLoaded('countries')),

        ];
    }
}
