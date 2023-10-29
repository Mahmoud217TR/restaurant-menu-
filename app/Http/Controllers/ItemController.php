<?php

namespace App\Http\Controllers;

use App\Actions\Item\CreateAction;
use App\Actions\Item\DeleteAction;
use App\Actions\Item\UpdateAction;
use App\Http\Requests\Item\StoreRequest;
use App\Http\Requests\Item\UpdateRequest;
use App\Models\Item;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ItemResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Item::class);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $category = new CategoryResource(Category::findOrFail($request->category));
        return Inertia::render('Item/Create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, CreateAction $action)
    {
        $category = $request->getCategory();

        abort_if(
            !$category->isOwnedBy(auth()->user()) ||
            $category->hasChildren(),
            422,
            "Invalid Category"
        );

        $item = $action->execute(
            $category,
            $request->name,
            $request->price,
            $request->getCurrency()
        );

        return redirect()->route('category.show', $category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $item = new ItemResource($item);
        return Inertia::render('Item/Edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Item $item, UpdateAction $action)
    {
        $action->execute(
            $item,
            $request->name,
            $request->price,
            $request->getCurrency(),
        );

        return redirect()->route('category.show', $item->category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item, DeleteAction $action)
    {
        $category_id = $item->category_id;
        $action->execute($item);

        return redirect()->route('category.show', $category_id);
    }
}
