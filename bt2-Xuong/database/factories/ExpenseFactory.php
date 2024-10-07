<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Testing\Fakes\Fake;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::query()->pluck('id')->toArray();
        return [
            'expense_type'  =>fake()->name(),
            'amount'        =>fake()->randomFloat(2,1,100),
            'description'   =>fake()->text(100),
            'user_id'       =>fake()->randomElement($userId),
        ];
    }
}
