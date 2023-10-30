<?php

namespace App\Repositories;

use App\Models\Contracts\Discountable;
use App\Models\Discount;

class DiscountRepository
{
    public function assign(Discountable $discountable, float $percentage): Discount
    {
        $discount = $discountable->discount;

        if (filled($discount)) {
            $discount->update([
                'percentage' => $percentage,
            ]);
        } else {
            $discount = $discountable->discount()->create([
                'percentage' => $percentage,
            ]);
        }


        return $discount;
    }

    public function delete(Discount $discount): bool
    {
        return $discount->delete();
    }
}
