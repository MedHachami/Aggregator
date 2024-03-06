<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $dateDebut = Carbon::now()->subDays(6);

        for ($i = 0; $i < 20; $i++) {
            $dateCreation = $dateDebut->copy()->addDays(rand(0, 5))->addHours(rand(0, 23))->addMinutes(rand(0, 59))->addSeconds(rand(0, 59));

            $post = new Post([
                'title' => 'Post Title ' . $i,
                'description' => 'Description for post ' . $i,
                'image' => $faker->imageUrl(640, 480), // Generates a fake image URL
                'url'=>$faker->imageUrl(640, 480),
                'category_id' => rand(1, 3),
                'created_at' => $dateCreation,
                'updated_at' => $dateCreation,
            ]);

            $post->save();
        }
    }
}