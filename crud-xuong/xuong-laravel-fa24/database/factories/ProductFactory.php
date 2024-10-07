<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        $CategoryId = Category::query()->pluck('id')->toArray();
        return [
            'category_id'=>fake()->randomElement( $CategoryId),
            'product_name'=>fake()->name(),
            'description'=>fake()->text(200),
        ];
    }
}
