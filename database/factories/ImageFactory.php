<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'img_path' => $this->fakeImage(),
        ];
    }

    private function fakeImage(): string
    {
        $imageUrl = 'https://picsum.photos/640/640';
        $imageContents = file_get_contents($imageUrl);
        $imageName = 'products/' . Str::random(2) . date("dmoHis") . '.jpg';

        Storage::disk('public')->put($imageName, $imageContents);

        return $imageName;
    }
}
