<?php

namespace App\Filters;

use Closure;

class CategoryFilter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('category_id')) {
            return $next($request);
        }

        $builder = $next($request);
        return $builder->whereHas('company', function ($query) {
            $query->where('name', 'like', '%' . request()->input('company') . '%');
        });    }
}
