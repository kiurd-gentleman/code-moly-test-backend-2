<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobTypes = [
            ['name' => 'Full-time', 'description' => 'Full-time job'],
            ['name' => 'Part-time', 'description' => 'Part-time job'],
            ['name' => 'Contract', 'description' => 'Contract job'],
            ['name' => 'Temporary', 'description' => 'Temporary job'],
            ['name' => 'Internship', 'description' => 'Internship job'],
            ['name' => 'Remote', 'description' => 'Remote job'],
        ];

        foreach ($jobTypes as $jobType) {
            \App\Models\JobType::create($jobType);
        }
    }
}
