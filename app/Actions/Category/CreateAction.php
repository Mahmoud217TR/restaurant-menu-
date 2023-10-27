<?php

namespace App\Actions\Category;

use App\Models\Category;
use App\Models\Menu;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\DB;
use Spatie\QueueableAction\QueueableAction;

class CreateAction
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
    public function execute(Menu $menu, string $name, Category $parent = null): Category
    {
        return DB::transaction(fn () => $this->categories->create(
            $menu,
            $name,
            $parent
        ));
    }
}
