<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static USD()
 * @method static static SYP()
 * @method static static KWD()
 */
final class Currency extends Enum
{
    const USD = "USD";
    const SYP = "SYP";
    const KWD = "KWD";

    public static function getDefaultCurrency()
    {
        return self::fromValue(config('app.default_currency'));
    }
}
