<?php

namespace App\Http\Controllers;

use App\Http\Requests\Discount\StoreRequest;
use App\Http\Requests\Discount\UpdateRequest;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Discount::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Discount $discount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        //
    }
}
