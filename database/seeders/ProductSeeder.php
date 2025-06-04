<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->count() > 0) {
            foreach ($categories as $category) {
                Product::factory()->count(3)->create([
                    'category_id' => $category->id
                ]);
            }
        }
    }
}
