<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company_id',
        'location',
        'job_type_id',
        'category_id',
        'salary_min',
        'salary_max',
        'experience_level',
        'industry',
        'benefits',
        'skills',
        'description',
    ];

    protected $casts = [
        'benefits' => 'array',
        'skills' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
