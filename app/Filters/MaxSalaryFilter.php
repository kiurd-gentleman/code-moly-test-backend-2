<?php

namespace App\Filters;

class MaxSalaryFilter
{
    public function handle($request, $next)
    {
        if (!request()->has('max_salary')) {
            return $next($request);
        }

        $builder = $next($request);
        return $builder->where('salary_max', '<=', request()->input('max_salary'));
    }

}
