<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;
use Log;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        $faker->addProvider(new FakerPicsumImagesProvider($faker));
       
       
        for($i=0;$i<5;$i++){

            $imageName = $faker->image(storage_path('app/public/slider'), 800, 600, false);
            
            Slider::create([
                'title' => $faker->sentence($faker->numberBetween(6,10)),
                'description' => $faker->paragraph(),
                'img' => 'slider/' . $imageName, 
            ]);

        }
         

    }
}
