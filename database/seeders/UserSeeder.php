<?php

namespace Database\Seeders;

use App\Models\DepartmentAdmin;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CSE
        DepartmentAdmin::create([
            'name' => 'CSE Admin',
            'email' => 'cse@mail.com',
            'password' => 'password',
            'department_id' => 1
        ]);

        // EEE
        DepartmentAdmin::create([
            'name' => 'EEE Admin',
            'email' => 'eee@mail.com',
            'password' => 'password',
            'department_id' => 2
        ]);

        // BBA
        DepartmentAdmin::create([
            'name' => 'BBA Admin',
            'email' => 'bba@mail.com',
            'password' => 'password',
            'department_id' => 3
        ]);

        // LAW
        DepartmentAdmin::create([
            'name' => 'LAW Admin',
            'email' => 'law@mail.com',
            'password' => 'password',
            'department_id' => 5
        ]);

        Teacher::create([
            'name' => 'Teacher CSE',
            'email' => 'teacher@mail.com',
            'password' => 'password',
            'department_id' => 1
        ]);
        Teacher::create([
            'name' => 'Teacher EEE',
            'email' => 'eee@mail.com',
            'password' => 'password',
            'department_id' => 2
        ]);
    }
}
