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
    protected $table = 'audit_log';


    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class,'participantId','id')->withTrashed();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'userId','id');
    }

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class,'blogId','id')->withTrashed();
    }

    public function setting(): BelongsTo
    {
        return $this->belongsTo(Setting::class,'settingId','id');
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class,'scheduleId','id')->withTrashed();
    }

}
