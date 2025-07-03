<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->words(3, true),
            'kategori' => $this->faker->randomElement(['Electronics', 'Clothing', 'Books', 'Home & Garden', 'Sports']),
            'harga' => $this->faker->randomFloat(2, 10, 1000),
            'stok' => $this->faker->numberBetween(0, 100),
            'deskripsi' => $this->faker->paragraph,
            'namaFile' => $this->faker->imageUrl(640, 480, 'products', true),
        ];
    }
}
