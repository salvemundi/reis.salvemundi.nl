<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static demandBased()
 * @method static static courseBased()
 * @method static static unknown()
 */
final class StudyType extends Enum
{
    const demandBased = 0;
    const courseBased = 1;
    const unknown     = 2;

    public static function getDescription($value): string
    {
        if ($value === self::demandBased) {
            return 'Demand Based Learning';
        }
        if ($value === self::courseBased) {
            return 'Coursed Based Learning';
        }
        if ($value === self::unknown) {
            return 'Weet ik nog';
        }

        return parent::getDescription($value);
    }
}