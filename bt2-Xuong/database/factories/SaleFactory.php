<?php

namespace Database\Factories;

use App\Models\product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productId = product::query()->pluck('id')->toArray();
        $userId = User::query()->pluck('id')->toArray();
        return [
            'product_id'   =>fake()->randomElement($productId),
            'total_amount' =>fake()->randomFloat(2,1,100),
            'quantity'     =>fake()->randomNumber(4,true),
            'price'        =>fake()->randomFloat(2,1,100),
            'tax'          =>fake()->randomFloat(2,1,100),
            'final_amount' =>fake()->randomFloat(2,1,100),
            'user_id'      =>fake()->randomElement($userId),
        ];
    }
}
