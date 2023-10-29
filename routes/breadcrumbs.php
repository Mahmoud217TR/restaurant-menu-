<?php

use App\Models\Category;
use App\Models\Item;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Support\Str;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Dashboard > [Category]
Breadcrumbs::for('category.show', function (BreadcrumbTrail $trail, Category $category) {
    $trail->parent('dashboard');
    registerCategories($trail, $category);
});

function registerCategories(BreadcrumbTrail &$trail, Category $category = null)
{
    if (is_null($category)) {
        return;
    }

    registerCategories($trail, $category->parent);

    $trail->push(Str::limit($category->name, 12, '...'), route('category.show', $category));
}
