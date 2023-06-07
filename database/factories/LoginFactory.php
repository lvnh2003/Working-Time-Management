<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Login>
 */
class LoginFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email'=> fake()->unique()->safeEmail(),
            'password' => bcrypt('123456'), 
             'role' => fake()->randomElement([1, 2]), 
             'isActive' => 1,
        ];
    }
}
