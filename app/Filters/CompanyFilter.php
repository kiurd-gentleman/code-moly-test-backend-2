<?php

namespace App\Filters;

use Closure;

class CompanyFilter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('company_id')) {
            return $next($request);
        }

        $builder = $next($request);
        return $builder->where('company_id', request()->input('company_id'));
    }
}
