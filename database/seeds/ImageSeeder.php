<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $laptop = ['laptop1.jpg','laptop2.jpg','laptop3.jpg','laptop4.jpg'];
        $ram = ['ram1.jpg','ram2.jpg'];
        $ssd = ['ssd1.jpg','ssd2.jpg'];
        $mouse = ['mouse1.jpg','mouse2.jpg'];
        $kboard = ['kboard1.jpg','kboard2.jpg','kboard3.jpg'];
        $hdd = ['hdd1.jpg','hdd2.jpg','hdd3.jpg'];

        for ($i=1; $i <= 30; $i++) { 
            if ($i<= 10) {
                shuffle($laptop);
                for ($l=0; $l < count($laptop); $l++) { 
                    DB::table('images')->insert([
                        'name' => "laptop/$laptop[$l]",
                        'product_id' => $i
                    ]);
                }
            }
            else if($i <= 15){
                shuffle($ram);
                for ($l=0; $l < count($ram); $l++) { 
                    DB::table('images')->insert([
                        'name' => "ram/$ram[$l]",
                        'product_id' => $i
                    ]);
                }
            }
            else if($i <= 20){
                DB::table('images')->insert([
                    'name' => 'battery/battery1.jpg',
                    'product_id' => $i
                ]);
            }
            else if($i <= 23){
                shuffle($ssd);
                for ($l=0; $l < count($ssd); $l++) { 
                    DB::table('images')->insert([
                        'name' => "ssd/$ssd[$l]",
                        'product_id' => $i
                    ]);
                }
            }
            else if($i <= 26){
                shuffle($hdd);
                for ($l=0; $l < count($hdd); $l++) { 
                    DB::table('images')->insert([
                        'name' => "hdd/$hdd[$l]",
                        'product_id' => $i
                    ]);
                }
            }
            else if($i <= 28){
                shuffle($mouse);
                for ($l=0; $l < count($mouse); $l++) { 
                    DB::table('images')->insert([
                        'name' => "mouse/$mouse[$l]",
                        'product_id' => $i
                    ]);
                }
            }
            else if($i <= 30){
                shuffle($kboard);
                for ($l=0; $l < count($kboard); $l++) { 
                    DB::table('images')->insert([
                        'name' => "keyboard/$kboard[$l]",
                        'product_id' => $i
                    ]);
                }
            }
        }
    }
}
