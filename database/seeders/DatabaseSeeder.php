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

        DepartmentAdmin::create([
            'name' => 'Department Admin',
            'email' => 'dept-admin@mail.com',
            'password' => bcrypt('password')
        ]);
    }
}
