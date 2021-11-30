<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');


        for ($i = 1; $i <= 30; $i++) {
            $pixel = $faker->randomElement([2, 4, 6, 8, 16, 20.7, 32, 48, 64, 108]);
            $battery = $faker->randomElement([13000, 6000, 2400]);
            $ram = $faker->randomElement([2, 4, 8, 16, 32, 64]);
            $storage = $faker->randomElement([128,256,512,1024]);
            $type = $faker->randomElement(['Wireless','Cable']);
            
            if ($i<= 10) {
                $spec = "$ram;$pixel;".rand(10, 20).";$battery";
                $category = 1;
                $price = rand(151, 200) * 100000;
            }
            else if($i <= 15){
                $spec = $ram;
                $category = 2;
                $price = rand(5, 25) * 100000;
            }
            else if($i <= 20){
                $spec = $battery;
                $category = 3;
                $price = rand(10, 20) * 100000;
            }
            else if($i <= 23){
                $spec = $storage;
                $category = 4;
                $price = rand(5, 15) * 100000;
            }
            else if($i <= 26){
                $spec = $storage;
                $category = 5;
                $price = rand(2, 10) * 100000;
            }
            else if($i <= 28){
                $spec = $type;
                $category = 6;
                $price = rand(1, 3) * 100000;
            }
            else if($i <= 30){
                $spec = $type;
                $category = 7;
                $price = rand(5, 10) * 100000;
            }
            DB::table('products')->insert([
                'name' => Str::random(10),
                'spec' => $spec,
                // 'ram' => $ram,
                // 'camera' => rand(10, 20),
                // 'screen' => $pixel,
                // 'battery' => $battery,
                'stock' => rand(20, 30),
                'price' => $price,
                'category_id' => $category,
                'brand_id' => rand(1, 4)
            ]);
        }
    }
}
