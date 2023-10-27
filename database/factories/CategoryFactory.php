<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'menu_id' =>  Menu::factory(),
            'parent_id' => null,
        ];
    }

    public function forMenu(Menu $menu): static
    {
        return $this->state(fn (array $attributes) => [
            'menu_id' => $menu->id,
        ]);
    }

    public function childOf(Category $category): static
    {
        return $this->state(fn (array $attributes) => [
            'parent_id' => $category->id,
        ]);
    }
}
