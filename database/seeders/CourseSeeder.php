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
        # CSE
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

        # EEE
        $eee = ['Circuit 1', 'Circuit 2', 'Circuit 3 ', 'Circuit 4'];
        $code = ['EEE1', 'EEE2', 'EEE3', 'EEE4'];
        for ($i = 0; $i < 4; $i++) {
            Course::create([
                'department_id' => 2,
                'name' => $eee[$i],
                'code' => $code[$i],
                'credit' => 3
            ]);
        }

        # LAW
        $law = ['LAW1', 'LAW2', 'LAW3', 'LAW4'];
        $code =  ['LAW1', 'LAW2', 'LAW3', 'LAW4'];
        for ($i = 0; $i < 4; $i++) {
            Course::create([
                'department_id' => 2,
                'name' => $law[$i],
                'code' => $law[$i],
                'credit' => 5
            ]);
        }
    }
}
