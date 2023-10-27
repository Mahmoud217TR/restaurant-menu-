<?php

namespace App\Models\Traits;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasDiscount
{
    public function hasDiscount(): bool
    {
        return $this->discount()->exists();
    }

    public function discount(): MorphOne
    {
        return $this->morphOne(Discount::class, 'discountable');
    }
}
