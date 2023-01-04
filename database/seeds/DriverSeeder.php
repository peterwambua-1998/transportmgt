<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Kenedy Oluoch',
            'staff_num' => 'ST12',
            'email' => 'ken@mail.com',
            'phone_num' => '072134711',
            'password' => Hash::make('12345678'),
            'user_type' => 'driver'

        ]);


        DB::table('users')->insert([
            'name' => 'Van Dem',
            'staff_num' => 'ST11',
            'email' => 'vandem@mail.com',
            'phone_num' => '075134789',
            'password' => Hash::make('12345678'),
            'user_type' => 'driver'

        ]);

        DB::table('users')->insert([
            'name' => 'Larry Wenga',
            'staff_num' => 'ST19',
            'email' => 'larry@mail.com',
            'phone_num' => '072234711',
            'password' => Hash::make('12345678'),
            'user_type' => 'driver'
        ]);
    }
}
