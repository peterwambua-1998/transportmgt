<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Peter Wambua',
            'email' => 'pwambua@gmail.com',
            'password' => Hash::make('admin123'),
            'user_type' => 'office staff'
        ]);

        DB::table('users')->insert([
            'name' => 'Kenedy Oluoch',
            'staff_num' => 'ST12',
            'email' => 'ken@mail.com',
            'phone_num' => '072134711',
            'password' => Hash::make('12345678'),
            'user_type' => 'driver'

        ]);
    }
}
