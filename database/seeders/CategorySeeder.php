<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'News', 'description' => "News: Timely updates on current events, global affairs, politics, business, science, technology, and culture, providing concise and relevant information to keep you informed. Covering breaking news, analysis, and trends, the News category delivers a snapshot of the world's happenings in a brief and insightful manner"],
            ['name' => 'Technology', 'description' => 'Technology category description'],
            ['name' => 'Business', 'description' => 'Business category description'],
            ['name' => 'Sports', 'description' => 'Sports category description'],
        ];

        foreach ($categories as $category) {
            $existingCategory = DB::table('categories')->where('name', $category['name'])->first();

            if (!$existingCategory) {
                DB::table('categories')->insert($category);
            }
        }
    }
}
