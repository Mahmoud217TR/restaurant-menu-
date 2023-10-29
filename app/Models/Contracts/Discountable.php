<?php

namespace App\Models\Contracts;

use App\Models\User;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Relations\MorphOne;

interface Discountable
{
    public function getDiscountPercentage(): float;
    public function hasDiscount(): bool;
    public function discount(): MorphOne;
    public function isOwnedBy(User $user): bool;
}
