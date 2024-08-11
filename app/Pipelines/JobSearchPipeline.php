<?php

namespace App\Pipelines;

use App\Filters\MaxSalaryFilter;
use App\Filters\MinAndMaxSalaryFilter;
use App\Filters\TitleFilter;
use App\Filters\CompanyFilter;
use App\Filters\JobTypeFilter;
use App\Filters\CategoryFilter;
use App\Filters\BenefitFilter;
use App\Filters\SkillsFilter;
use Illuminate\Pipeline\Pipeline;

class JobSearchPipeline
{
    public static function apply($builder)
    {
        return app(Pipeline::class)
            ->send($builder->with(['company', 'category','jobType']))
            ->through([
                TitleFilter::class,
                CompanyFilter::class,
                JobTypeFilter::class,
                CategoryFilter::class,
                BenefitFilter::class,
                SkillsFilter::class,
                MinAndMaxSalaryFilter::class,
                MaxSalaryFilter::class
            ])
            ->thenReturn();
    }
}

