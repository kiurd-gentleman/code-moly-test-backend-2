<?php

namespace App\Filters;

class MinAndMaxSalaryFilter
{
    public function handle($request, $next)
    {
        if (!request()->has('min_salary')) {
            return $next($request);
        }

        $builder = $next($request);
        return $builder->where(function ($query) {
            $query
                ->where('salary_min', '>=', request()->input('min_salary'));
//                ->where('salary_max', '=<', request()->input('max_salary'));
//                ->where('salary_max', '>=', request()->input('max_salary'));
        });
    }

}
