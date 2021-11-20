<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuid;

class VerificationToken extends Model
{
    use UsesUuid;

    protected $table = 'verify_email';

    protected $guarded = [];

    public function participant()
    {
        return $this->belongsTo(Participant::class,'participantId','id');
    }
}
