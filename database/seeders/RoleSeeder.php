<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем роли администратора и пользователя
        Role::firstOrCreate(['title' => 'admin']);
        Role::firstOrCreate(['title' => 'user']);
    }
}
