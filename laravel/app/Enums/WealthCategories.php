<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Poor()
 * @method static static LowIncome()
 * @method static static MiddleClass()
 * @method static static HighIncome()
 * @method static static Rich()
 */
final class WealthCategories extends Enum
{
    const Poor = 0;
    const LowIncome = 1;
    const MiddleClass = 2;
    const HighIncome = 3;
    const Rich = 4;
}
