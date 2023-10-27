<?php

namespace App\Actions\Discount;

use App\Models\Discount;
use App\Repositories\DiscountRepository;
use Illuminate\Support\Facades\DB;
use Spatie\QueueableAction\QueueableAction;

class UpdateAction
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
    public function execute(Discount $discount, float $percentage)
    {
        return DB::transaction(fn () => $this->discounts->update(
            $discount,
            $percentage
        ));
    }
}
