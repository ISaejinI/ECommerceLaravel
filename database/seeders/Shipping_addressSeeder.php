<?php

namespace Database\Seeders;

use App\Models\Shipping_address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Shipping_addressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shipping_address::factory(10)
        ->create();
    }
}
