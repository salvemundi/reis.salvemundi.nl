<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuid;

class ConfirmationToken extends Model
{
    use UsesUuid;

    protected $table = 'confirm_signup_request';

    protected $guarded = [];

    public function participant() {
        return $this->belongsTo(Participant::class,'participantId','id');
    }
}
