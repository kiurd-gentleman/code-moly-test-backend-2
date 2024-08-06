<?php

namespace App\Filters;

use Closure;

class JobTypeFilter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('job_type_id')) {
            return $next($request);
        }

        $builder = $next($request);
        return $builder->where('job_type_id', request()->input('job_type_id'));
    }
}
