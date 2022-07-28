<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use UsesUuid;
    // Yea I know lol \/
    protected $table = 'content';

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class,'blogId','id');
    }
}
