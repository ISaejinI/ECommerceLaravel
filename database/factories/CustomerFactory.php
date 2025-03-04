<?php

namespace Database\Factories;

use App\Enums\CustomerGenre;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'genre' => CustomerGenre::class,
            'phone' => fake()->phoneNumber(),
            'birth_date' => fake()->dateTimeBetween('-80years', '-18years')->format('Y-m-d'),
        ];
    }
}
