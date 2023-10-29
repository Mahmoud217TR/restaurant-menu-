<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Item;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            "email" => 'user@restaurant.menu'
        ]);

        $menu = Menu::factory()->forUser($user)->create();
        Discount::factory()->forDiscountable($menu)->create();

        Category::factory(3)
            ->forMenu($menu)
            ->create()
            ->each(function ($category) use ($menu) {
                Category::factory(2)
                    ->forMenu($menu)
                    ->childOf($category)
                    ->create()
                    ->each(function ($subCategory) {
                        Item::factory(4)
                            ->forCategory($subCategory)
                            ->create()
                            ->each(function ($item) {
                                Discount::factory()->forDiscountable($item)->create();
                            });
                        Discount::factory()->forDiscountable($subCategory)->create();
                    });
                Discount::factory()->forDiscountable($category)->create();
            });
    }
}
