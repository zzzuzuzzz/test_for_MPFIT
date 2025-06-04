<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $adminRole = Role::firstOrCreate(['title' => 'admin']);
        $userRole = Role::firstOrCreate(['title' => 'user']);

        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Администратор',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@user.com'],
            [
                'name' => 'Пользователь',
                'password' => Hash::make('password'),
                'role_id' => $userRole->id,
                'email_verified_at' => now(),
            ]
        );
    }
}
