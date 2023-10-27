<?php

namespace App\Actions\Discount;

use App\Models\Discount;
use App\Repositories\DiscountRepository;
use Illuminate\Support\Facades\DB;
use Spatie\QueueableAction\QueueableAction;

class DeleteAction
{
    use QueueableAction;

    public DiscountRepository $discounts;

    /**
     * Create a new action instance.
     *
     * @return void
     */
    public function __construct(DiscountRepository $discounts)
    {
        $this->discounts = $discounts;
    }

    /**
     * Execute the action.
     *
     * @return mixed
     */
    public function execute(Discount $discount): bool
    {
        return DB::transaction(fn () => $this->discounts->delete(
            $discount
        ));
    }
}
