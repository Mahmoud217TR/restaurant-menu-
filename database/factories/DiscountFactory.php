<?php

namespace Database\Factories;

use App\Models\Contracts\Discountable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "percentage" => fake()->numberBetween(0, 100),
        ];
    }

    public function forDiscountable(Discountable $discountable): static
    {
        return $this->state(fn (array $attributes) => [
            'discountable_id' => $discountable->id,
            'discountable_type' => get_class($discountable),
        ]);
    }
}
