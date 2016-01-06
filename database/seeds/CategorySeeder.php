<?php

use Illuminate\Database\Seeder;

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
            'name' => 'Work'
        ]);
        DB::table('categories')->insert([
            'name' => 'Shopping'
        ]);
        DB::table('categories')->insert([
            'name' => 'House Work'
        ]);

    }
}
