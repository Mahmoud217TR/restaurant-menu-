<?php

namespace App\Actions\Item;

use App\Models\Item;
use App\Repositories\ItemsRepository;
use Illuminate\Support\Facades\DB;
use Spatie\QueueableAction\QueueableAction;

class DeleteAction
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
    public function execute(Item $item): bool
    {
        return DB::transaction(fn() => $this->items->delete(
            $item
        ));
    }
}
