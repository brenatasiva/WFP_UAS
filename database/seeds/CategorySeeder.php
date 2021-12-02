<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'name' => 'Laptop',
            'type' => 'laptop',
        ]);
        DB::table('categories')->insert([
            'name' => 'Ram',
            'type' => 'sparepart',
            'unit' => 'GB',
        ]);
        DB::table('categories')->insert([
            'name' => 'Battery',
            'type' => 'sparepart',
            'unit' => 'mAh',
        ]);
        DB::table('categories')->insert([
            'name' => 'SSD',
            'type' => 'sparepart',
            'unit' => 'GB',
        ]);
        DB::table('categories')->insert([
            'name' => 'HDD',
            'type' => 'sparepart',
            'unit' => 'GB',
        ]);
        DB::table('categories')->insert([
            'name' => 'Mouse',
            'type' => 'accessories',
        ]);
        DB::table('categories')->insert([
            'name' => 'Keyboard',
            'type' => 'accessories',
        ]);
    }
}
