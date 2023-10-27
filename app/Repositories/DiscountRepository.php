<?php

namespace App\Repositories;

use App\Models\Contracts\Discountable;
use App\Models\Discount;

class DiscountRepository
{
    public function create(Discountable $discountable, float $percentage): Discount
    {
        return $discountable->discount()->create([
            'percentage' => $percentage,
        ]);
    }

    public function update(Discount $discount, float $percentage): Discount
    {
        $discount->update([
            'percentage' => $percentage,
        ]);

        return $discount;
    }

    public function delete(Discount $discount): bool
    {
        return $discount->delete();
    }
}
