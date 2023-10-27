<?php

namespace App\Models\Contracts;

use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Relations\MorphOne;

interface Discountable
{
    public function getDiscountPercentage(): float;
    public function hasDiscount(): bool;
    public function discount(): MorphOne;
}
