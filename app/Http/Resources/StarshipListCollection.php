<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StarshipListCollection extends ResourceCollection
{
    public $collects = StarshipListResource::class;

    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}