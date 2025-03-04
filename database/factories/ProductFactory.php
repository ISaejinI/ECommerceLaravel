<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $slug = fake()->word();
        return [
            'label' => $slug,
            'slug' => Str::slug($slug),
            'description' => fake()->paragraph(1, false),
            'price' => fake()->randomNumber(2, true),
            'stock' => fake()->randomNumber(2, false),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function ($product) {
            $product->categories()->attach(
                Category::inRandomOrder()->limit(rand(1, 3))->pluck('id')
            );
        });
    }
}
