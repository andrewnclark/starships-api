<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

abstract class QueryFilters {
    protected $request;

    protected $buidler;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (! method_exists($this, $filter)) {
                continue;
            }

            if (strlen($value)) {
                $this->$filter($value);
            } else {
                $this->$filter();
            }
        };

        return $this->builder;
    }

    private function getFilters(): array
    {
        return $this->request->all();
    }
}