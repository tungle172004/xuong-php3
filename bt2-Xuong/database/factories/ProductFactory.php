<?php

namespace Database\Factories;

use App\Models\category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = category::query()->pluck('id')->toArray();
        return [
            'category_id'   =>fake()->randomElement($category),
            'name'          =>fake()->name(),
            'price'         =>fake()->randomFloat(2,1,100),
            'description'   =>fake()->text(100),
        ];
    }
}
