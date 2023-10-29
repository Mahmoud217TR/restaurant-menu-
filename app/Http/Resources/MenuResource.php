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
        return [
            'id' => $this->id,
            'categories' => CategoryResource::collection($this->when($this->relationLoaded('categories'), $this->categories, $this->rootCategories)),
            'discount' => new DiscountableResource($this),
        ];
    }
}
