<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($users->count() > 0 && $products->count() > 0) {
            foreach ($users as $user) {
                $orderCount = rand(1, 3);

                for ($i = 0; $i < $orderCount; $i++) {
                    $product = $products->random();

                    Order::create([
                        'product_id' => $product->id,
                        'count' => rand(1, 5),
                        'user_id' => $user->id,
                        'status' => rand(0, 1) ? 'new' : 'completed',
                        'description' => rand(0, 1) ? 'Комментарий к заказу' : null,
                    ]);
                }
            }
        }
    }
}
