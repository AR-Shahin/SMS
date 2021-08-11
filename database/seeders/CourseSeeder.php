<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cse = ['Programming Language C', 'Programming Language JAVA', 'Computer Fundamental', 'Computer Architecture'];
        $code = ['CSE101', 'CSE102', 'CSE103', 'CSE104'];
        for ($i = 0; $i < 4; $i++) {
            Course::create([
                'department_id' => 1,
                'name' => $cse[$i],
                'code' => $code[$i],
                'credit' => 3
            ]);
        }
    }
}
