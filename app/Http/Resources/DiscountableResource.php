<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $discount_percentage = $this->getDiscountPercentage();
        $direct_discount_percentage = optional($this->discount)->percentage;
        $discount_id = optional($this->discount)->id;

        return [
            'discount_percentage' => $this->when($discount_percentage, $discount_percentage),
            'direct_discount_percentage' => $this->when($direct_discount_percentage, $direct_discount_percentage),
            'discount_id' => $this->when($discount_id, $discount_id),
        ];
    }
}
