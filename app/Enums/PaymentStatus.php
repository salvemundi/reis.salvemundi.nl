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
    const open =   0;
    const pending =   1;
    const authorized = 2;
    const canceled = 3;
    const expired = 4;
    const paid = 4;
    const failed = 5;
}
