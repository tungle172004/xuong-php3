<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::query()->pluck('id')->toArray();
       
        // dd($userId);
        return [
            'user_id'=>fake()->randomElement($userId),
            'amount'=>fake()->randomNumber(5, true),
            'total_spent'=>fake()->randomNumber(5,true),
            'order_date'=>fake()->dateTime(),
            'order_count'=>fake()->numberBetween(1,20),
            'total_amount'=>fake()->randomFloat(2,1,100),

        ];
    }
}
