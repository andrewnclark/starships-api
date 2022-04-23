<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StarshipResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'class' => $this->class,
            'image' => $this->image,
            'value' => $this->value,
            'crew' => $this->crew,
            'armament' => ArmamentResource::collection($this->whenLoaded('armaments')),
        ];
    }
}