<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Sergio Vargas",
            'email' => "sergio@virtua.mx",
            'password' => Hash::make('12345678')
        ]);


        User::create([
            'name' => "Alberto Ramirez",
            'email' => "alberto@refaccionesvictorino.com.mx",
            'password' => Hash::make('12345678')
        ]);

        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('12345678'),
            ]);
        }
    }
}
