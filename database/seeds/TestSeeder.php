<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tests')->insert([
            'name' => "PCR test" ,
            'price' => "30000",
            'quantity' => "10",
        ]);
        DB::table('tests')->insert([
            'name' => "Blood sugar test" ,
            'price' => "20000",
            'quantity' => "20",
        ]);
        DB::table('tests')->insert([
            'name' => "Flu vaccine" ,
            'price' => "20000",
            'quantity' => "20",
        ]);
        DB::table('tests')->insert([
            'name' => "Covid-19 vaccine" ,
            'price' => "200000",
            'quantity' => "20",
        ]);
        DB::table('tests')->insert([
            'name' => "Influenza virus vaccine" ,
            'price' => "100000",
            'quantity' => "20",
        ]);
    }
}
