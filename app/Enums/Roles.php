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
    const participant = 0;
    const crew = 1;

    public static function getDescription($value): string
    {
        if ($value === self::participant) {
            return 'Deelnemer';
        }
        if ($value === self::crew) {
            return 'Crew';
        }

        return parent::getDescription($value);
    }
}
