<?php

namespace Database\Factories;

use App\Models\department;
use App\Models\manager;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
        
        // $imagePath = fake()->image();
        return [
            'first_name'        =>fake()->firstName,
            'last_name'         =>fake()->lastName,
            'email'             =>fake()->unique()->email(),
            'phone'             =>substr(fake()->phoneNumber(),0,15),
            'date_of_birth'     =>fake()->dateTimeThisYear,
            'hire_date'         =>fake()->dateTime,
            'salary'            =>fake()->randomFloat(2,1000,10000),
            'is_active'         =>rand(0,1),
            'department_id'     =>fake()->randomNumber(3,true),
            'manager_id'        =>fake()->randomNumber(3,true),
            'address'           =>fake()->address,
            // 'profile_picture'   =>file_get_contents( $imagePath),
        ];
    }
}
