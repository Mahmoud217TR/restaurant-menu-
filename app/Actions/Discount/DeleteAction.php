<?php

namespace App\Actions\Discount;

use Spatie\QueueableAction\QueueableAction;

class DeleteAction
{
    use QueueableAction;

    /**
     * Create a new action instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Prepare the action for execution, leveraging constructor injection.
    }

    /**
     * Execute the action.
     *
     * @return mixed
     */
    public function execute()
    {
        // The business logic goes here.
    }
}