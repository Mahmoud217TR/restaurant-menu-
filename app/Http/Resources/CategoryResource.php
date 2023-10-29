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
        $hasChildren = $this->hasChildren();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'subcategories' => $this->when($hasChildren, self::collection($this->children)),
            'items' => $this->when($hasItems, ItemResource::collection($this->items)),
            'discount' => new DiscountableResource($this),
        ];
    }
}
