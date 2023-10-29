<?php

namespace App\Repositories;

use App\Models\Contracts\Discountable;
use App\Models\Discount;

class DiscountRepository
{
    public function assign(Discountable $discountable, float $percentage): Discount
    {
        return $discountable->discount()->updateOrCreate([
            'percentage' => $percentage,
        ]);
    }

    public function delete(Discount $discount): bool
    {
        return $discount->delete();
    }
}
