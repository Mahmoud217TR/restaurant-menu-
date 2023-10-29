<?php declare(strict_types=1);

namespace App\Enums;

use App\Models\Category;
use App\Models\Item;
use App\Models\Menu;
use BenSampo\Enum\Enum;
/**
 * @method static static Menu()
 * @method static static Category()
 * @method static static Item()
 */
final class DiscountableType extends Enum
{
    const Menu = 'menu';
    const Category = 'category';
    const Item = 'item';

    public function getModelClass(): string
    {
        switch ($this->value) {
            case self::Menu:
                return Menu::class;
            case self::Category:
                return Category::class;
            case self::Item:
                return Item::class;
        }
    }
}
