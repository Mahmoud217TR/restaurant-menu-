<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'categories' => CategoryResource::collection(
                $this->categories()
                    ->roots()
                    ->with('children', 'items')
                    ->get()
            ),
            'discount_percentage' => $this->when($discount, $discount),
        ];
    }
}
