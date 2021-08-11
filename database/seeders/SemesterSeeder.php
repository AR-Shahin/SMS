<?php

namespace Database\Seeders;

use App\Models\Semester;
use App\Models\Session;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semesters = ['First', 'Second'];
        Semester::create([
            'session_id' => 5,
            'name' => $semesters[0]
        ]);
        Semester::create([
            'session_id' => 5,
            'name' => $semesters[1]
        ]);
        Semester::create([
            'session_id' => 4,
            'name' => $semesters[0]
        ]);
        Semester::create([
            'session_id' => 4,
            'name' => $semesters[1]
        ]);
        Semester::create([
            'session_id' => 3,
            'name' => $semesters[0]
        ]);
        Semester::create([
            'session_id' => 3,
            'name' => $semesters[1]
        ]);
        Semester::create([
            'session_id' => 2,
            'name' => $semesters[0]
        ]);
        Semester::create([
            'session_id' => 5,
            'name' => $semesters[1]
        ]);
    }
}
