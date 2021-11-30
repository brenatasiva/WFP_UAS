<?php

use Illuminate\Database\Seeder;
use  Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('brands')->insert([
            'name' => 'Asus',
        ]);
        DB::table('brands')->insert([
            'name' => 'Acer',
        ]);
        DB::table('brands')->insert([
            'name' => 'Dell',
        ]);
        DB::table('brands')->insert([
            'name' => 'Lenovo',
        ]);
    }
}
