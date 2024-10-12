<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Passport>
 */
class PassportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $idStudent = Student::pluck('id')->all();
        return [
            'student_id' =>fake()->randomElement($idStudent),
           'passport_number'=>fake()->randomNumber(3),
            'issued_date' =>fake()->date() ,
            'expiry_date' =>fake()->date(),
        ];
    }
}
