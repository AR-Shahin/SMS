<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 15; $i++) {
            Teacher::create([
                'name' => 'Teacher ' . $i,
                'email' => 'teacher' . $i . '@mail.com',
                'password' => 'password',
                'department_id' => rand(1, 5)
            ]);
        }
    }
}
