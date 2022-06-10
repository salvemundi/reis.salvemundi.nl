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

    protected $keyType = 'string';

    protected $table = 'participants';

    // protected $fillable = ['insertion', 'firstNameParent', 'lastNameParent', 'addressParent', 'medicalIssues', 'specials', 'phoneNumberParent', 'studentNumber'];

    protected $fillable = ['firstName', 'insertion', 'lastName', 'birthday', 'email', 'studentNumber', 'phoneNumber', 'firstNameParent', 'lastNameParent', 'addressParent', 'phoneNumberParent', 'medicalIssues', 'role', 'checkedIn'];

    public function verificationToken() {
        return $this->belongsTo(VerificationToken::class,'id','participantId','verify_email');
    }

    public function confirmationToken() {
        return $this->belongsTo(ConfirmationToken::class,'id','participantId','confirm_signup_request');
    }

    public function getFullName() {
        if($this->insertion != "" || $this->insertion != null){
            $name = $this->firstName . " " . $this->insertion . " " . $this->lastName;
        } else {
            $name = $this->firstName . " " . $this->lastName;
        }
        return $name;
    }

    public function payments(){
        return $this->hasMany(Payment::class,'participant_id','id');
    }
}
