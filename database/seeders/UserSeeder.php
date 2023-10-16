<?php

namespace Database\Seeders;

use App\Models\Permission;
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
            $user_role = User::create($user);
            $user_role->syncRoles(['User']);
        }

        $user = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('Q@W#E$P@ssw0rd'),
        ]);

        // Adding permissions via a role
        $user->syncRoles(['Super Admin']);
    }
}
