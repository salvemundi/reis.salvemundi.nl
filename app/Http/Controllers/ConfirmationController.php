<?php

namespace App\Http\Controllers;

use App\Models\ConfirmationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailConfirmationSignup;

class ConfirmationController extends Controller
{
    private $participantController;
    private $paymentController;
    private $verifiedController;

    public function __construct() {
        $this->participantController = new ParticipantController();
        $this->paymentController = new PaymentController();
        $this->verifiedController = new VerificationController();
    }

    public function confirmSignUpView(Request $request) {
        $token = ConfirmationToken::find($request->token);

        if(!$token) {
            return redirect('/')->with('error','Jij bent neppert!! pffff');
        }

        return view('confirmSignup')->with(['confirmationToken' => $token]);
    }

    public function confirm(Request $request) {
        $token = $request->token;
        $confirmationToken = ConfirmationToken::find($token)->latest()->first();
        $user = $confirmationToken->participant;

        if ($token && $confirmationToken !== null) {
            if($confirmationToken->confirmed) {
                $newConfirmationToken = new ConfirmationToken();
                $newConfirmationToken->participant()->associate($user);
                $newConfirmationToken->save();
                $confirmationToken = $newConfirmationToken;
            }

            $confirmationToken->confirmed = true;
            $confirmationToken->save();
            $this->participantController->store($request);

            return $this->paymentController->payForIntro($confirmationToken->id);
        }

        return back()->with('error','input is not valid');
    }

    public function sendConfirmEmailToAllUsers() {
        $verifiedParticipants = $this->verifiedController->getVerifiedParticipants();

        foreach($verifiedParticipants as $participant) {
            $newConfirmationToken = new ConfirmationToken();
            $newConfirmationToken->participant()->associate($participant);
            $newConfirmationToken->save();

            Mail::to($participant->email)
                ->send(new emailConfirmationSignup($participant, $newConfirmationToken));
        }

        return back()->with('status','Mails zijn verstuurd!');
    }

}
