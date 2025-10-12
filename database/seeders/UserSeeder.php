<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $faker = Faker::create();
        $faker->addProvider(new FakerPicsumImagesProvider($faker));
       
       
        for($i=0;$i<7;$i++){

            $imageName = $faker->image(storage_path('app/public/profile'), 800, 600, false);
            
            User::create([
                'username' => $faker->unique()->name(),
                'email'=> $faker->email,
                'fullname' => $faker->firstName(),
                'password' => '1234',
                'picture' => 'profile/' . $imageName, 
                'type' => 'customer'
            ]);

        }


    }
}
