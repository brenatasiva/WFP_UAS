<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
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
        for ($i=1; $i <= 3; $i++) { 
            DB::table('users')->insert([
                'username' => $faker->userName(),
                'password' => bcrypt('secret'),
                'fullname' => $faker->name(),
                'status' => 'active',
                'role_id' => $i
            ]);
        }
    }
}
