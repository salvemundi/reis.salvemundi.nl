<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static DownPayment()
 * @method static static FinalPayment()
 */
final class PaymentTypes extends Enum
{
    const DownPayment = 0;
    const FinalPayment = 1;
}
