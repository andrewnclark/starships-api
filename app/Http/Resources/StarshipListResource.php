<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StarshipListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
        ];
    }
}