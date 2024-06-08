<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Config;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $districts = Config::get('database.departments.lima');

        return [
            'description' => $this->faker->sentence(),
            'district'    => $this->faker->randomElement($districts),
            'state'       => $this->faker->randomElement([1, 3]),
        ];
    }
}
