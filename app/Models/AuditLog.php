<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = ['category','description'];

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class,'participantId','id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'userId','id');
    }

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class,'blogId','id');
    }

    protected $table = 'audit_log';
}
