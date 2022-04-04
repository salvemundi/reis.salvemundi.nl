<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Order\Contracts\ProvidesInvoiceInformation;

class Participant extends Model implements ProvidesInvoiceInformation
{
    use HasFactory;
    use Notifiable;
    use UsesUuid;
    use Billable;

    protected $keyType = 'string';

    protected $table = 'participants';

    protected $fillable = ['insertion', 'firstNameParent', 'lastNameParent', 'addressParent', 'medicalIssues', 'specials', 'phoneNumberParent'];

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

    public function mollieCustomerFields() {
        $name = $this->getFullName();
        return [
            'email' => $this->email,
            'name' => $name,
        ];
    }

    public function getInvoiceInformation() {
        $name = $this->getFullName();
        return [$name, $this->email];
    }

    public function getExtraBillingInformation() {
        return null;
    }
}
