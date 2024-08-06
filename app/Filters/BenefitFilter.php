<?php

namespace App\Filters;

use Closure;

class BenefitFilter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('benefit')) {
            return $next($request);
        }

        $builder = $next($request);
        $benefits = request()->input('benefit');
        foreach ($benefits as $benefit) {
            $builder->whereJsonContains('benefit', $benefit);
        }

        return $builder;
    }
}
