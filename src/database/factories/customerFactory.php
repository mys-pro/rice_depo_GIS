<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\customer>
 */
class customerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\customer::class;
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->numerify('0#########'),
            'email' => fake()->unique()->safeEmail(),
            'gender' => fake()->randomElement([0, 1]),
        ];
    }
}
