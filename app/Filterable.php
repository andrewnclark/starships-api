<?php

namespace App;

use App\Http\Filters\QueryFilters;

trait Filterable 
{
    public function scopeFilter($query, QueryFilters $filters)
    {
        return $filters->apply($query);
    }
}