<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Config;

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
        $categories = Config::get('database.products.category');

        return [
            'description' => $this->faker->sentence(),
            'category' => $this->faker->randomElement($categories),
            'state' => $this->faker->randomElement([1, 3]), // Active by default unless specified differently
            'description_category' => $this->faker->sentence(),
            'unit_price' => $this->faker->randomFloat(2, 10, 1000), // Random price between 0 and 1000.00
        ];
    }
}
