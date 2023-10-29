<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static USD()
 * @method static static SYP()
 */
final class Currency extends Enum
{
    const USD = "USD";
    const SYP = "SYP";

    public static function getDefaultCurrency()
    {
        return self::fromValue(config('app.default_currency'));
    }
}
