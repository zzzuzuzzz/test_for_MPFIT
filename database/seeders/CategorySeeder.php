<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем категории в соответствии с требованиями
        Category::firstOrCreate(['title' => 'легкий']);
        Category::firstOrCreate(['title' => 'хрупкий']);
        Category::firstOrCreate(['title' => 'тяжелый']);
    }
}
