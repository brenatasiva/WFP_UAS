<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=1; $i <=10; $i++) { 
            for ($j=1; $j <= 4; $j++) { 
                DB::table('images')->insert([
                    'name' => $j,
                    'product_id' => $i
                ]);
            }
        }
    }
}
