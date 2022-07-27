<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    use HasFactory, UsesUuid;

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class,'id','participantId');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'id','userId');
    }

    protected $table = 'audit_log';
}
