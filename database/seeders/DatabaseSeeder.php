<?php

namespace Database\Seeders;

use App\Models\DepartmentAdmin;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password')
        ]);

        // CSE
        DepartmentAdmin::create([
            'name' => 'Department Admin',
            'email' => 'dept-admin@mail.com',
            'password' => 'password',
            'department_id' => 1
        ]);
        // eee
        DepartmentAdmin::create([
            'name' => 'EEE Admin',
            'email' => 'eee@mail.com',
            'password' => 'password',
            'department_id' => 2
        ]);
        $this->call([
            DepartmentSeeder::class,
            SessionSeeder::class,
            CourseSeeder::class,
            SemesterSeeder::class
        ]);
    }
}
