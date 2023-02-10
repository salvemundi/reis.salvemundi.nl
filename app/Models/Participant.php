<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use App\Enums\PaymentTypes;
use App\Enums\Roles;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Participant extends Model
{
    use HasFactory, SoftDeletes, Notifiable, UsesUuid;

    protected $keyType = 'string';

    protected $appends = array('hasCompletedDownPayment', 'hasCompletedFinalPayment', 'above18');

    protected $table = 'participants';

    protected $fillable = ['firstName', 'insertion', 'lastName', 'birthday', 'email', 'phoneNumber', 'medicalIssues', 'role', 'checkedIn', 'isOnReserveList'];

    public  function getHaspaidAttribute(): bool {
        return $this->hasCompletedAllPayments();
    }

    public function activities() {
        return $this->belongsToMany(Activity::class);
    }

    public function getAbove18Attribute(): bool {
        $age = Carbon::parse($this->birthday)->diff(Carbon::now())->format('%y');
        if($age >= 18) {
            return true;
        } else {
            return false;
        }
    }

    public function verificationToken(): BelongsTo
    {
        return $this->belongsTo(VerificationToken::class,'id','participantId','verify_email');
    }

    public function confirmationToken(): BelongsTo
    {
        return $this->belongsTo(ConfirmationToken::class,'id','participantId','confirm_signup_request');
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class,'participantId','id');
    }

    public function getFullName(): string
    {
        if($this->insertion != "" || $this->insertion != null){
            $name = $this->firstName . " " . $this->insertion . " " . $this->lastName;
        } else {
            $name = $this->firstName . " " . $this->lastName;
        }
        return $name;
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class,'participant_id','id');
    }

    public function hasCompletedDownPayment(): bool {
        foreach($this->payments()->get() as $payment) {
            if($payment->paymentStatus === PaymentStatus::paid && $payment->paymentType === PaymentTypes::DownPayment) {
                return true;
            }
        }
        return false;
    }

    public function hasCompletedFinalPayment(): bool {
        foreach($this->payments()->get() as $payment) {
            if($payment->paymentStatus === PaymentStatus::paid && $payment->paymentType === PaymentTypes::FinalPayment) {
                return true;
            }
        }
        return false;
    }

    public function hasCompletedAllPayments(): bool {
        return $this->hasCompletedDownPayment() && $this->hasCompletedFinalPayment();
    }

    public function isVerified():bool {
        foreach($this->verificationToken()->get() as $token) {
            if($token->verified) {
                return true;
            }
        }
        return false;
    }
}
