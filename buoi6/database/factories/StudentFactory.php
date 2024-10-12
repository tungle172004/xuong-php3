<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $idClass = Classroom::pluck('id')->all();
        return [
            'classroom_id' =>fake()->randomElement($idClass),
            'name' =>fake()->name(),
            'email' =>fake()->email(),
        ];
    }
}
