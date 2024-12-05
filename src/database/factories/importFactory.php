<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\import>
 */
class importFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\import::class;
    public function definition(): array
    {
        $createdAt = fake()->dateTimeBetween('2020-01-01', '2024-12-31');

        return [
            'user_id' => fake()->numberBetween(2, 101),
            'customer_id' => fake()->numberBetween(1, 100),
            'warehouse_id' => fake()->numberBetween(1, 8),
            'created_at' => $createdAt,
            'updated_at' => fake()->dateTimeBetween($createdAt, '2024-12-31'), // `updated_at` luôn sau `created_at`
        ];
    }
}
