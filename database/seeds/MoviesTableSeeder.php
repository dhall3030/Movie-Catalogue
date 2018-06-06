<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->insert([
            'name' => 'Comando',
            'year' => '1985',
            'category_id' => 1,
            'Description' => 'testing',
        ]);

        DB::table('movies')->insert([
            'name' => 'Terminator',
            'year' => '1984',
            'category_id' => 1,
            'Description' => 'testing',
        ]);

        DB::table('movies')->insert([
            'name' => 'Robo Cop',
            'year' => '1988',
            'category_id' => 1,
            'Description' => 'testing',
        ]);
    }
}
