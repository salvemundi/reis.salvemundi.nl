<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static string()
 * @method static static boolean()
 * @method static static integer()
 * @method static static date()
 */
final class SettingTypes extends Enum
{
    const string = 0;
    const boolean = 1;
    const integer = 2;
    const date = 3;
}
