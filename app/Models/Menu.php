<?php

namespace App\Models;

use App\Models\Contracts\Discountable;
use App\Models\Traits\HasDiscount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model implements Discountable
{
    use HasFactory;
    use HasDiscount;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function rootCategories(): HasMany
    {
        return $this->categories()->whereNull('parent_id');
    }

    public function getDiscountPercentage(): float
    {
        return $this->hasDiscount() ? $this->discount->percentage : 0;
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->user_id == $user->id;
    }
}
