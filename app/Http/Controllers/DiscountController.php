<?php

namespace App\Http\Controllers;

use App\Actions\Discount\AssignAction;
use App\Actions\Discount\DeleteAction;
use App\Enums\DiscountableType;
use App\Http\Requests\Discount\AssignRequest;
use App\Models\Category;
use App\Models\Contracts\Discountable;
use App\Models\Discount;
use App\Models\Item;

class DiscountController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Discount::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function put(AssignRequest $request, AssignAction $action)
    {
        $discountable = $request->getDiscountable();

        abort_if(!$discountable->isOwnedBy(auth()->user()), 403);

        $discount = $action->execute($discountable, $request->percentage);

        switch ($request->discountable_type) {
            case DiscountableType::Item:
                return redirect()->route('item.edit', $discountable->id);
            case DiscountableType::Category:
                return redirect()->route('category.edit', $discountable->id);
            default:
                return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount, DeleteAction $action)
    {
        $discountable_type = $discount->discountable_type;
        $discountable_id = $discount->discountable_id;

        $action->execute($discount);

        switch ($discountable_type) {
            case Item::class:
                return redirect()->route('item.edit', $discountable_id);
            case Category::class:
                return redirect()->route('category.edit', $discountable_id);
            default:
                return redirect()->route('dashboard');
        }
    }
}
