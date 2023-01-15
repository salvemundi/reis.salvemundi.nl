<?php

namespace App\Http\Controllers;

use App\Jobs\resendConfirmationEmailToAllUsers;
use App\Models\ConfirmationToken;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailConfirmationSignup;
use App\Enums\PaymentStatus;
use App\Models\Participant;

class ConfirmationController extends Controller
{
    private ParticipantController $participantController;
    private PaymentController $paymentController;
    private VerificationController $verifiedController;
    private ActivityController $activityController;

    public function __construct() {
        $this->participantController = new ParticipantController();
        $this->paymentController = new PaymentController();
        $this->verifiedController = new VerificationController();
        $this->activityController = new ActivityController();
    }

    public function confirmSignUpView(Request $request): View|Factory|Redirector|RedirectResponse|Application
    {
        $token = ConfirmationToken::find($request->token);

        if(!$token) {
            return redirect('/')->with('error','Jij bent neppert!! pffff');
        }

        return view('confirmSignup')->with(['confirmationToken' => $token,'activities' => $this->activityController->index()]);
    }

    public function confirm(Request $request): Response|RedirectResponse
    {
        $token = $request->token;
        $confirmationToken = ConfirmationToken::find($token);
        $user = $confirmationToken->participant;
        if(Setting::where('name','ConfirmationEnabled')->first()->value == 'false') {
            return back()->with('error','Inschrijvingen zijn helaas gesloten!');
        }
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
                return $this->paymentController->payForReis($confirmationToken->id, Setting::where('name','Aanbetaling')->first()->value);
            }
            return back()->with('success','Je gegevens zijn opgeslagen!');
        }
        return back()->with('error','input is not valid');
    }

    public function sendConfirmEmailToAllUsers(): RedirectResponse
    {
        $verifiedParticipants = $this->verifiedController->getVerifiedParticipants();

        foreach($verifiedParticipants as $participant) {
            if (!$participant->hasPaid()) {
                $newConfirmationToken = new ConfirmationToken();
                $newConfirmationToken->participant()->associate($participant);
                $newConfirmationToken->save();

                resendConfirmationEmailToAllUsers::dispatch($participant,$newConfirmationToken);
            }
        }
        return back()->with('status','Mails zijn verstuurd!');
    }
}
