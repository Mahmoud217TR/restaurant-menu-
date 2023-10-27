<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $discount = $this->getDiscountPercentage();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price->format(),
            'discount_percentage' => $this->when($discount, $discount),
            'discount_price' => $this->when($discount, $this->getDiscountPrice()->format()),
        ];
    }
}
