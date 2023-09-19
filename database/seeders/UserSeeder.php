<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Q@W#E$P@ssw0rd'),
            ],
            [
                'name' => 'eslam',
                'email' => 'eslam@gmail.com',
                'password' => Hash::make('P@ssw0rd'),
            ],
            [
                'name' => 'mohamed',
                'email' => 'mohamed@gmail.com',
                'password' => Hash::make('P@ssw0rd'),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
