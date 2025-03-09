<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping_address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total_amount' => 0,
            'status' => fake()->randomElement(OrderStatus::cases()),
            'shipping_address_id' => Shipping_address::inRandomOrder()->first()->id,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Order $order) {
            $productsAdd = Product::inRandomOrder()->limit(rand(1, 4))->get();
            $totPrice = 0;
            foreach ($productsAdd as $product) {
                $quantity = rand(1, 5);
                $order->products()->attach(
                    $product->id,
                    [
                        'quantity' => $quantity,
                        'price' => $product->price*100,
                    ]
                );
                $totPrice += ($product->price*100) * $quantity;
            }
            $order->total_amount = $totPrice;
            $order->save();
        });
    }
}