<?php

namespace App\Pipelines\Filters;

use Closure;

class Company
{
    public function handle($request, Closure $next)
    {
        if (request()->has('company')) {
            $builder = $next($request);
            return $builder->whereHas('company', function ($query) {
                $query->where('name', 'like', '%' . request()->input('company') . '%');
            });
        }

        return $next($request);
    }
}

