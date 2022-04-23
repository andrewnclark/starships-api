<?php

namespace App\Http\Controllers;

use App\Http\Resources\StarshipResource;
use App\Models\Starship;

class StarshipsController extends Controller
{
    public function index()
    {
        return StarshipResource::collection(Starship::all());
    }
}