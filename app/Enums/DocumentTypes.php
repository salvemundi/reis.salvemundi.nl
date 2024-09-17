<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static UNKNOWN()
 * @method static static IDCard()
 * @method static static Passport()
 */
final class DocumentTypes extends Enum
{
    const UNKNOWN = 0;
    const IDCard = 1;
    const Passport = 2;

    public static function getDescription($value): string
    {
        return match ($value) {
            self::UNKNOWN => 'Onbekend',
            self::IDCard => 'ID Card / Identiteitskaart',
            self::Passport => 'Passport / Paspoort',
            default => parent::getDescription($value),
        };

    }
}


