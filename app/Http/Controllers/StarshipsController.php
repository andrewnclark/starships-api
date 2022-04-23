<?php

namespace App\Http\Controllers;

use App\Http\Filters\StarshipFilters;
use App\Http\Requests\CreateStarshipRequest;
use App\Http\Resources\StarshipListCollection;
use App\Http\Resources\StarshipResource;
use App\Jobs\CreateStarshipJob;
use App\Models\Starship;

class StarshipsController extends Controller
{
    public function index(StarshipFilters $filters)
    {
        return new StarshipListCollection(Starship::filter($filters)->get());
    }

    public function show(Starship $starship)
    {
        $starship->load('armaments');

        return new StarshipResource($starship);
    }

    public function store(CreateStarshipRequest $request)
    {
        $this->dispatch(new CreateStarshipJob($request->all()));
    }
}