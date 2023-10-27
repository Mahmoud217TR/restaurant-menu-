<?php

namespace App\Actions\Item;

use App\Enums\Currency;
use App\Models\Item;
use App\Repositories\ItemsRepository;
use Illuminate\Support\Facades\DB;
use Spatie\QueueableAction\QueueableAction;

class UpdateAction
{
    use QueueableAction;

    public ItemsRepository $items;

    /**
     * Create a new action instance.
     *
     * @return void
     */
    public function __construct(ItemsRepository $items)
    {
        $this->items = $items;
    }

    /**
     * Execute the action.
     *
     * @return mixed
     */
    public function execute(Item $item, string $name, string $price, Currency $currency): Item
    {
        return DB::transaction(fn() => $this->items->update(
            $item,
            $name,
            $price,
            $currency
        ));
    }
}
