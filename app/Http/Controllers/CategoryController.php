<?php

namespace App\Http\Controllers;

use App\Actions\Category\CreateAction;
use App\Actions\Category\DeleteAction;
use App\Actions\Category\UpdateAction;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $parent = $request->parent;
        return Inertia::render('Category/Create', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, CreateAction $action)
    {
        $parent = $request->getParentCategory();

        abort_if(
            $parent &&
            (!$parent->isOwnedBy(auth()->user()) || $parent->hasItems() || $parent->hasFullChildrenLimit()),
            422,
            "Invalid Parent Category"
        );

        $category = $action->execute(
            auth()->user()->menu,
            $request->name,
            $parent
        );

        return redirect()->route('category.show', $category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = new CategoryResource($category->load('children', 'items'));
        return Inertia::render('Category/Show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $category = new CategoryResource($category);
        return Inertia::render('Category/Edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category, UpdateAction $action)
    {
        $action->execute(
            $category,
            $request->name
        );

        return redirect()->route('category.show', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, DeleteAction $action)
    {
        $parent_id = $category->parent_id;
        $action->execute($category);

        if (filled($parent_id)) {
            return redirect()->route('category.show', $parent_id);
        }
        return redirect()->route('dashboard');
    }
}
