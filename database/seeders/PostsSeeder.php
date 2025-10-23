<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Post;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');

        for ($i=0; $i < 20; $i++) { 
            Post::create([
                'title' => $faker->sentence(6, true),
                'slug' => $faker->unique()->slug(),
                'content' => $faker->paragraphs(8, true),
                'author' => $faker->name(),
                'user_id' => $faker->numberBetween(1, 2)
            ]);
        }
    }
}
