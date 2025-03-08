<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(25)
        ->has(
            Image::factory(2)
            ->state(new Sequence(
                ['is_cover' => true],
                ['is_cover' => false]
            ))
        )
        ->create();
    }
}
