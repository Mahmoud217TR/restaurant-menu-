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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'subcategories' => $this->when($this->relationLoaded('children'), self::collection($this->children)),
            'items' => $this->when($this->relationLoaded('items'), ItemResource::collection($this->items)),
            'discount' => new DiscountableResource($this),
            'parent_id' => $this->parent_id,
        ];
    }
}
