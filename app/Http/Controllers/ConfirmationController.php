<?php

namespace App\Http\Controllers;

use App\Models\ConfirmationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailConfirmationSignup;
use App\Enums\PaymentStatus;

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

    public function confirmSignUpView(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $token = ConfirmationToken::find($request->token);

        if(!$token) {
            return redirect('/')->with('error','Jij bent neppert!! pffff');
        }

        return view('confirmSignup')->with(['confirmationToken' => $token]);
    }

    public function confirm(Request $request): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        $token = $request->token;
        $confirmationToken = ConfirmationToken::find($token);
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
            if(!$this->paymentController->checkIfParticipantPaid($user)) {
                return $this->paymentController->payForIntro($confirmationToken->id);
            }
            return back()->with('success','Je gegevens zijn opgeslagen!');
        }
        return back()->with('error','input is not valid');
    }

    public function sendConfirmEmailToAllUsers(): \Illuminate\Http\RedirectResponse
    {
        $verifiedParticipants = $this->verifiedController->getVerifiedParticipants();

        foreach($verifiedParticipants as $participant) {
            $participant->latestPayment = $participant->payments()->latest()->first();

            if ($participant->latestPayment == null || $participant->latestPayment->paymentStatus != PaymentStatus::paid) {
                $newConfirmationToken = new ConfirmationToken();
                $newConfirmationToken->participant()->associate($participant);
                $newConfirmationToken->save();

                Mail::to($participant->email)
                    ->send(new emailConfirmationSignup($participant, $newConfirmationToken));
            }
        }
        return back()->with('status','Mails zijn verstuurd!');
    }
}
