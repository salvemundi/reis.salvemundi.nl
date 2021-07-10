<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Roles extends Enum
{
    const child = 0;
    const dad_mom = 1;
    const teacher = 2;
    const crew = 3;

    public static function getDescription($value): string
    {
        if ($value === self::child) {
            return 'Kiddo';
        }
        if ($value === self::dad_mom) {
            return 'Ouder / Begeleiding';
        }
        if ($value === self::teacher) {
            return 'Leraar';
        }
        if ($value === self::crew) {
            return 'Crew';
        }

        return parent::getDescription($value);
    }
}
