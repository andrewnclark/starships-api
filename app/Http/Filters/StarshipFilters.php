<?php

namespace App\Http\Filters;

use App\Http\Filters\QueryFilters;
use Illuminate\Database\Eloquent\Builder;

class StarshipFilters extends QueryFilters
{
    public function name(string $name): Builder
    {
        return $this->builder->where('name', $name);
    }

    public function status(string $status): Builder
    {
        return $this->builder->where('status', $status);
    }
}