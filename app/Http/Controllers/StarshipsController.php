<?php

namespace App\Http\Controllers;

use App\Http\Filters\StarshipFilters;
use App\Http\Resources\StarshipListCollection;
use App\Http\Resources\StarshipResource;
use App\Models\Starship;

class StarshipsController extends Controller
{
    public function index(StarshipFilters $filters)
    {
        return new StarshipListCollection(Starship::filter($filters)->get());
    }

    public function view(Starship $starship)
    {
        $starship->load('armaments');

        return new StarshipResource($starship);
    }
}