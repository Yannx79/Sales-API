<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Time>
 */
class TimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'month' => $this->faker->numberBetween(1, 12),
            'month_description' => $this->faker->randomElement(config('database.time.month_description')),
            'year' => $this->faker->year,
            'week' => $this->faker->numberBetween(1, 52), // Assuming 52 weeks in a year
            'week_description' => $this->faker->randomElement(config('database.time.week_description')), // Week description based on weekday
            'state' => $this->faker->randomElement([1, 3]),
        ];
    }
}
