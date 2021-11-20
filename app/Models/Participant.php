<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Participant extends Model
{
    use HasFactory;
    use Notifiable;
    use UsesUuid;

    protected $table = 'participants';

    protected $fillable = ['insertion', 'firstNameParent', 'lastNameParent', 'addressParent', 'medicalIssues', 'specials', 'phoneNumberParent', 'verified'];

    public function verificationToken() {
        return $this->belongsTo(VerificationToken::class,'id','participantId','verify_email');
    }
}
