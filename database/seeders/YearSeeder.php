<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Year::create([
            'session_id' => 5,
            'name' => '1st'
        ]);

        Year::create([
            'session_id' => 5,
            'name' => '2nd'
        ]);
        Year::create([
            'session_id' => 4,
            'name' => '1st'
        ]);
        Year::create([
            'session_id' => 4,
            'name' => '2nd'
        ]);
        Year::create([
            'session_id' => 3,
            'name' => '1st'
        ]);
        Year::create([
            'session_id' => 3,
            'name' => '2nd'
        ]);
    }
}
