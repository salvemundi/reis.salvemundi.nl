<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static open()
 * @method static static pending()
 * @method static static authorized()
 * @method static static canceled()
 * @method static static expired()
 * @method static static paid()
 * @method static static failed()
 */
final class PaymentStatus extends Enum
{
    const open = 0;
    const pending = 1;
    const authorized = 2;
    const canceled = 3;
    const expired = 4;
    const paid = 5;
    const failed = 6;

    public static function getDescription($value): string
    {
        return match ($value) {
            self::open => 'Open',
            self::pending => 'In verwerking',
            self::authorized => 'geautoriseerd',
            self::canceled => 'geannuleerd',
            self::expired => 'Verlopen',
            self::paid => 'Betaald',
            self::failed => 'Gefaald',
            default => parent::getDescription($value),
        };

    }
}
