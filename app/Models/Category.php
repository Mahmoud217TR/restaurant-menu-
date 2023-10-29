<?php

namespace App\Models;

use App\Models\Contracts\Discountable;
use App\Models\Traits\HasDiscount;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model implements Discountable
{
    use HasFactory;
    use HasDiscount;

    protected $fillable = [
        'name',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function scopeRoots(Builder $query): void
    {
        $query->whereNull('parent_id');
    }

    public function getDiscountPercentage(): float
    {
        if ($this->hasDiscount()) {
            return $this->discount->percentage;
        }

        if ($this->isSubCategory()) {
            return $this->parent->getDiscountPercentage();
        }

        return $this->menu->getDiscountPercentage();
    }

    public function isSubCategory(): bool
    {
        return $this->parent()->exists();
    }

    public function hasItems(): bool
    {
        return $this->items()->exists();
    }

    public function hasChildren(): bool
    {
        return $this->children()->exists();
    }

    public function hasFullChildrenLimit(): bool
    {
        return $this->children()->count() >= config('app.subcategory_limit');
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->menu_id == $user->menu->id;
    }
}
