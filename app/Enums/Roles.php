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
}
