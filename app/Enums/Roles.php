<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static child()
 * @method static static dad_mom()
 * @method static static teacher()
 * @method static static crew()
 * @method static static other()
 */
final class Roles extends Enum
{
    const child = 0;
    const dad_mom = 1;
    const teacher = 2;
    const crew = 3;
    const other = 4;

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
        if ($value === self::other) {
            return 'Overige';
        }

        return parent::getDescription($value);
    }
}
