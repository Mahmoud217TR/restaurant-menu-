<?php

namespace App\Models;

use App\Enums\Currency;
use App\Models\Contracts\Discountable;
use App\Models\Traits\HasDiscount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cknow\Money\Casts\MoneyDecimalCast;
use Cknow\Money\Money;

/**
 * @property Money $price
 */
class Item extends Model implements Discountable
{
    use HasFactory;
    use HasDiscount;

    protected $fillable = [
        'name',
        'price',
        'currency',
    ];

    public $casts = [
        'price' => MoneyDecimalCast::class.':currency',
        'currency' => Currency::class,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getDiscountPercentage(): float
    {
        return $this->hasDiscount() ? $this->discount->percentage : $this->category->getDiscountPercentage();
    }

    public function getDiscountPrice(): Money
    {
        return $this->price->subtract(
            $this->price->multiply($this->getDiscountPercentage())->divide(100)
        );
    }
}
