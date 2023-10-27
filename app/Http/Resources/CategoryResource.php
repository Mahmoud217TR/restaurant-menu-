<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $hasItems = $this->hasItems();
        $hasSubCategories = $this->hasSubCategories();
        $discount = $this->getDiscountPercentage();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'subcategories' => $this->when($hasSubCategories, self::collection($this->categories)),
            'items' => $this->when($hasItems, self::collection($this->items)),
            'discount_percentage' => $this->when($discount, $discount),
        ];
    }
}
