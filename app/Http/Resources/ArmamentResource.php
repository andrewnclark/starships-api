<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArmamentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'qty' => $this->pivot->quantity
        ];
    }
}