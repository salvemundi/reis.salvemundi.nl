<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use UsesUuid, SoftDeletes;
    // Yea I know lol \/
    protected $table = 'content';

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class,'blogId','id');
    }
}
