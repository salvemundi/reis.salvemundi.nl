<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CovidProof extends Enum
{
    const none = 0;
    const test = 1;
    const vaccin = 2;

    public static function getDescription($value): string
    {
        if ($value === self::none) {
            return 'Nog niet bekend';
        }
        if ($value === self::test) {
            return 'Test';
        }
        if ($value === self::vaccin) {
            return 'Vaccin';
        }

        return parent::getDescription($value);
    }
}
