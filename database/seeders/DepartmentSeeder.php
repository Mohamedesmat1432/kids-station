<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'IT'],
            ['name' => 'HR'],
            ['name' => 'Financial'],
            ['name' => 'CEO'],
            ['name' => 'Managment'],
            ['name' => 'Legal'],
            ['name' => 'Vice'],
            ['name' => 'Accounant'],
            ['name' => 'Audit'],
            ['name' => 'Investment'],
        ];
        
        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
