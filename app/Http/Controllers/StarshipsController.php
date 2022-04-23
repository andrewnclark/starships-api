<?php

namespace App\Http\Controllers;

use App\Http\Filters\StarshipFilters;
use App\Http\Resources\StarshipResource;
use App\Models\Starship;

class StarshipsController extends Controller
{
    public function index(StarshipFilters $filters)
    {
        return StarshipResource::collection(Starship::filter($filters)->get());
    }
}