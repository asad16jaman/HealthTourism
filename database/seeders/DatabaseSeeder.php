<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\VideoGallery;
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
        //   UserSeeder::class,

            // SliderSeeder::class,
            // CategorySeeder::class,
            // PhotoGallerySeeder::class,
            // VideoGallerySeeder::class,
            TeamSeeder::class,
            ClientSeeder::class,
            ContactSeeder::class,
            
            // ProductSeeder::class,
       ]);
    }
}
