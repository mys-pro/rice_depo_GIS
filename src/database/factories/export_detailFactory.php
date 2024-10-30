<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\import;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\import_detail>
 */
class export_detailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\export_detail::class;
    public function definition(): array
    {
        return [
            'export_id' => fake()->numberBetween(1, 100),
            'rice_id' => fake()->numberBetween(1, 14),
            'weight' => fake()->numberBetween(1, 1000),
            'price' => fake()->numberBetween(4000, 25000),
        ];
    }
}
