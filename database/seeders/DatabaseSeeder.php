<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            AppBasicSeeder::class,
            BannerSeeder::class,
            AboutSeeder::class,
            PostSeeder::class,
            ContactSeeder::class,
            ServiceSeeder::class,
            TestimonialSeeder::class,
            MachineSeeder::class,
            PartnerSeeder::class,
            BannerCarrouselSeeder::class,
            UserSeeder::class
        ]);
    }
}
