<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'id'        => $this->id,
            'content'   => $this->data,
            'read_at'   => $this->read_at ? $this->read_at->format('m-d-Y') : null,
            'created_at'   => $this->created_at
        ];
    }
}
