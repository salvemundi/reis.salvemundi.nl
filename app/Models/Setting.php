<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Setting extends Model
{
    use HasFactory;
    use usesUuid;

    protected $table = 'settings';

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class,'settingId','id');
    }
}
