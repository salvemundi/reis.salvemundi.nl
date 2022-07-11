<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConfirmationToken extends Model
{
    use UsesUuid;

    protected $table = 'confirm_signup_request';

    protected $guarded = [];

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class,'participantId','id');
    }
}
