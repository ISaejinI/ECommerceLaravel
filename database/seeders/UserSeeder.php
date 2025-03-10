<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)
            ->has(
                Customer::factory()
                    ->has(
                        Address::factory(2)
                            ->state(new Sequence(
                                ['is_default' => true],
                                ['is_default' => false]
                            )),
                    )
                    ->has(Cart::factory())
                    ->has(Order::factory(rand(1, 4)))
            )
            ->create();

        User::factory()
            ->has(
                Customer::factory()
                    ->has(
                        Address::factory(2)
                            ->state(new Sequence(
                                ['is_default' => true],
                                ['is_default' => false]
                            ))
                    )
            )
            ->create([
                'name' => 'LouAnne',
                'email' => 'admin@example.fr',
                'role' => UserRole::ADMIN,
            ]);
    }
}
