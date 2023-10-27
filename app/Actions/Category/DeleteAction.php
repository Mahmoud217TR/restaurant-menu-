<?php

namespace App\Actions\Category;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\DB;
use Spatie\QueueableAction\QueueableAction;

class DeleteAction
{
    use QueueableAction;

    public CategoryRepository $categories;

    /**
     * Create a new action instance.
     *
     * @return void
     */
    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Execute the action.
     *
     * @return mixed
     */
    public function execute(Category $category): bool
    {
        return DB::transaction(fn () => $this->categories->delete(
            $category
        ));
    }
}
