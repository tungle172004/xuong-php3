<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order_Item>
 */
class Order_ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order_id = Order::query()->pluck('id')->toArray();
        $product_id = Product::query()->pluck('id')->toArray();
        return [
            'order_id'  =>fake()->randomElement($order_id),
            'product_id'=>fake()->randomElement($product_id),
            'quantity'  =>fake()->randomNumber(3,true),
            'price'     =>fake()->randomFloat(2,1,100),
        ];
    }
}
