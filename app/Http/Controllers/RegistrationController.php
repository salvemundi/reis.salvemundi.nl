<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Participant;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    private VerificationController $verificationController;

    public function __construct() {
        $this->verificationController = new VerificationController();
    }

    public function getRegistrationsWithInformation(Request $request): Factory|View|Application
    {
        $participants = Participant::join('verify_email', 'verify_email.participantId', '=',  'participants.id')
               ->get(['participants.*', 'verify_email.verified', 'verify_email.updated_at']);

        $dateToday = Carbon::now()->toDate();
        foreach($participants as $participant) {
            if($participant->payments != null) {
                $participant->latestPayment = $participant->payments()->latest()->first();
            }
            $participant->dateDifference = $dateToday->diff($participant->created_at)->d;
        }

        $this->verificationController->getVerifiedParticipants();
        return view('admin/registrations', ['participants' => $participants]);
    }
}
