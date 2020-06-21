<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'name' => 'Chelsea',
            'rating' => 4
        ]);

        DB::table('teams')->insert([
            'name' => 'Arsenal',
            'rating' => 3
        ]);

        DB::table('teams')->insert([
            'name' => 'Manchester City',
            'rating' => 5
        ]);

        DB::table('teams')->insert([
            'name' => 'Liverpool',
            'rating' => 5
        ]);

    }
}
