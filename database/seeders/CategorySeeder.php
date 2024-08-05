<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Web Development', 'description' => 'Web Development category'],
            ['name' => 'Mobile Development', 'description' => 'Mobile Development category'],
            ['name' => 'Desktop Development', 'description' => 'Desktop Development category'],
            ['name' => 'Game Development', 'description' => 'Game Development category'],
            ['name' => 'Machine Learning', 'description' => 'Machine Learning category'],
            ['name' => 'Data Science', 'description' => 'Data Science category'],
            ['name' => 'DevOps', 'description' => 'DevOps category'],
            ['name' => 'Cloud Computing', 'description' => 'Cloud Computing category'],
            ['name' => 'Cybersecurity', 'description' => 'Cybersecurity category'],
            ['name' => 'Artificial Intelligence', 'description' => 'Artificial Intelligence category'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
