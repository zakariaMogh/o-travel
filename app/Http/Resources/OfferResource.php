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
            'user_favorite_by_me'  => $this->when(isset($this->user_favorite_by_me),$this->user_favorite_by_me),
            'company_favorite_by_me'  => $this->when(isset($this->company_favorite_by_me),$this->company_favorite_by_me),
            'state'  => $this->state,
            'featured'  => $this->featured,
            'start_date'  => $this->when($this->featured === 2 ,$this->start_date),
            'end_date'  => $this->when($this->featured === 2 ,$this->end_date),
            'link'  => $this->when($this->featured === 2 ,$this->link),
            'images'  => ImageResource::collection($this->whenLoaded('images')),
            'category'  => new CategoryResource($this->whenLoaded('category')),
            'company'  => new CompanyResource($this->whenLoaded('company')),
            'countries'  =>  CountryResource::collection($this->whenLoaded('countries')),

        ];
    }
}
