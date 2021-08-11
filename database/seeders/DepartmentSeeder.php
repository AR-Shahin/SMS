<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\DepartmentAdmin;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $depts = ['CSE', 'EEE', 'BBA', 'MBA', 'LAW'];

        for ($i = 0; $i < count($depts); $i++) {
            Department::create([
                'name' => $depts[$i]
            ]);
        }
    }
}
