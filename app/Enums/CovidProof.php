<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CovidProof extends Enum
{
    const none = 0;
    const test = 1;
    const vaccin = 2;
}
