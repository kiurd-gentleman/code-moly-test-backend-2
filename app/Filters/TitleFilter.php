<?php

namespace App\Filters;

use Closure;

class TitleFilter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('search')) {
            return $next($request);
        }

        $builder = $next($request);
        return $builder->where('title', 'like', '%' . request()->input('search') . '%');
    }
}
