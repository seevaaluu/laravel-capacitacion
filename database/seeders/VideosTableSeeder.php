<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Video;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');
        
        for ($i = 0; $i < 50; $i++) {
            Video::create([
                'title' => $faker->sentence(6, true),
                'url' => $faker->url(),
                'user_id' => $faker->numberBetween(1, 2)
            ]);
        }
    }
}
