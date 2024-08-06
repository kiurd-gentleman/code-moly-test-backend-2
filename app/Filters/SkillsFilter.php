<?php

namespace App\Filters;

use Closure;

class SkillsFilter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('skills')) {
            return $next($request);
        }

        $builder = $next($request);
        $skills = request()->input('skills');
        foreach ($skills as $skill) {
            $builder->whereJsonContains('skills', $skill);
        }

        return $builder;
    }
}
