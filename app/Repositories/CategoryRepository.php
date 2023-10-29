<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Menu;

class CategoryRepository
{
    public function create(Menu $menu, string $name, Category $parent = null): Category
    {
        $category = $menu->categories()->create([
            'name' => $name,
        ]);

        if (filled($parent)) {
            $category->parent()->associate($parent);
            $category->save();
        }

        return $category;
    }

    public function update(Category $category, string $name): Category
    {
        $category->update([
            'name' => $name,
        ]);

        return $category;
    }

    public function delete(Category $category): bool
    {
        if ($category->hasChildren()) {
            $category->children->each(function ($subcategory) {
                $this->delete($subcategory);
            });
        }

        return $category->delete();
    }
}
