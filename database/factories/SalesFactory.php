<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Store;
use App\Models\Time;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Config;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sales>
 */
class SalesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'items_sold' => $this->faker->numberBetween(1, 10),
            'sales_amount' => $this->faker->randomFloat(2, 10, 1000),
            'state' => $this->faker->randomElement([1, 3]),
            'store_id' => Store::get()->random()->id,
            'time_id' => Time::all()->random()->id,
            'product_id' => Product::all()->random()->id,

        ];
    }
}
