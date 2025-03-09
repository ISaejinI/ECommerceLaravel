<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Cart $cart) {
            $productsAdd = Product::inRandomOrder()->limit(rand(0, 4))->get();
            foreach ($productsAdd as $product) {
                $cart->products()->attach(
                    $product->id,
                    ['quantity' => rand(1, 5)]
                );
            }
        });
    }
}
