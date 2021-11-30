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
        ]);
        DB::table('categories')->insert([
            'name' => 'Ram',
        ]);
        DB::table('categories')->insert([
            'name' => 'Battery',
        ]);
        DB::table('categories')->insert([
            'name' => 'SSD',
        ]);
        DB::table('categories')->insert([
            'name' => 'HDD',
        ]);
        DB::table('categories')->insert([
            'name' => 'Mouse',
        ]);
        DB::table('categories')->insert([
            'name' => 'Keyboard',
        ]);
    }
}
