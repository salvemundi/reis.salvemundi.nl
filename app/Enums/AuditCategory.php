<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ParticipantManagement()
 * @method static static Other()
 */
final class AuditCategory extends Enum
{
    const ParticipantManagement = 0;
    const Other = 1;
}
