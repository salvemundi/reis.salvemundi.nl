<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static string()
 * @method static static boolean()
 * @method static static int()
 * @method static static date()
 * @method static static float()
 */
final class SettingTypes extends Enum
{
    const string = 0;
    const boolean = 1;
    const int = 2;
    const date = 3;
    const float = 4;
}
