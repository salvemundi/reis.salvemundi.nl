<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'schedule';

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class,'settingId','id');
    }
}
