<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('routes')->insert([
            'title' => 'abc',
            'description' => 'yaya center, abc place, westlands, mama rocks',
            'price'=>'1000'
        ]);

        DB::table('routes')->insert([
            'title' => 'buru',
            'description' => 'buruburu, jerico, umoja',
            'price'=>'700'
        ]);

        DB::table('routes')->insert([
            'title' => 'imara',
            'description' => 'imara daima, embakasi west, utawala',
            'price'=>'1200'
        ]);

        DB::table('routes')->insert([
            'title' => 'dohnhome',
            'description' => 'donhome, embakasi east',
            'price'=>'2000'
        ]);
    }
}
