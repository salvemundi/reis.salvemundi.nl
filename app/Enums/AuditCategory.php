<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Other()
 * @method static static ParticipantManagement()
 * @method static static BlogManagement()
 * @method static static Emailmanagement()
 */
final class AuditCategory extends Enum
{
    const Other = 0;
    const ParticipantManagement = 1;
    const BlogManagement = 2;
    const Emailmanagement = 3;
}
