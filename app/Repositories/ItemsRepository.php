<?php

namespace App\Repositories;

use App\Enums\Currency;
use App\Models\Category;
use App\Models\Item;
use Cknow\Money\Money;

class ItemsRepository
{
    public function create(Category $category, string $name, string $price, Currency $currency): Item
    {
        return $category->items()->create([
            'name' => $name,
            'price' => $price,
            'currency' => $currency,
        ]);
    }

    public function update(Item $item, string $name, string $price, Currency $currency): Item
    {
        $item->update([
            'name' => $name,
            'price' => $price,
            'currency' => $currency,
        ]);

        return $item;
    }

    public function delete(Item $item): bool
    {
        return $item->delete();
    }
}
