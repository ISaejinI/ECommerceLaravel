<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Address;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)
            ->has(Customer::factory()->has(Address::factory(2)))
            ->create();

        User::factory()->
        has(Customer::factory()->has(Address::factory(2)))
        ->
        create([
            'name' => 'LouAnne',
            'email' => 'saejinmx@gmail.com',
            'role' => UserRole::ADMIN,
        ]);
    }
}
