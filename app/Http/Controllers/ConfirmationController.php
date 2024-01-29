<?php

namespace App\Http\Controllers;

use App\Enums\PaymentTypes;
use App\Jobs\resendConfirmationEmailToAllUsers;
use App\Models\ConfirmationToken;
use App\Models\Participant;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class ConfirmationController extends Controller
{
    private ParticipantController $participantController;
    private PaymentController $paymentController;
    private VerificationController $verifiedController;
    private ActivityController $activityController;

    public function __construct()
    {
        $this->participantController = new ParticipantController();
        $this->paymentController = new PaymentController();
        $this->verifiedController = new VerificationController();
        $this->activityController = new ActivityController();
    }

    public function confirmSignUpView(Request $request): View|Factory|Redirector|RedirectResponse|Application
    {
        $token = ConfirmationToken::find($request->token);

        if (!$token || $token->confirmed) {
            return redirect('/')->with('error', 'Token is not valid!');
        }
        return view('confirmSignup')->with(['confirmationToken' => $token, 'activities' => $this->activityController->index(), 'price' => $this->paymentController->calculateFinalPrice($token), 'basePrice' => Setting::where('name', 'FinalPaymentAmount')->first()->value]);
    }

    public function confirm(Request $request): Response|RedirectResponse
    {
        $token = $request->token;
        $confirmationToken = ConfirmationToken::find($token);
        $user = $confirmationToken->participant;
        if (Setting::where('name', 'ConfirmationEnabled')->first()->value == 'false') {
            return back()->with('error', 'Confirmation signups are currently closed!');
        }
        if ($token && $confirmationToken !== null) {
            if ($confirmationToken->confirmed) {
                redirect('/')->with('error', 'This token is already confirmed!');
            }

            if (!$user->hasCompletedFinalPayment() && $user->hasCompletedDownPayment()) {
                $this->participantController->store($request, true);
                return $this->paymentController->payForReis($confirmationToken->id, $this->paymentController->calculateFinalPrice($confirmationToken), PaymentTypes::FinalPayment());
            }
            if (!$user->hasCompletedDownPayment()) {
                $this->participantController->store($request, true);
                return $this->paymentController->payForReis($confirmationToken->id, Setting::where('name', 'Aanbetaling')->first()->value, PaymentTypes::DownPayment());
            }
            $this->participantController->store($request);

            return back()->with('success', 'Information saved!');
        }
        return back()->with('error', 'input is not valid');
    }

    public function sendConfirmEmailToAllUsers(): RedirectResponse
    {
        $verifiedParticipants = $this->verifiedController->getVerifiedParticipants();
        /** @var Participant $participant */
        foreach ($verifiedParticipants as $participant) {
            if (!$participant->hasCompletedAllPayments()) {
                $newConfirmationToken = new ConfirmationToken();
                $newConfirmationToken->participant()->associate($participant);
                $newConfirmationToken->save();

                resendConfirmationEmailToAllUsers::dispatch($participant, $newConfirmationToken);
            }
        }
        return back()->with('status', 'Mails zijn verstuurd!');
    }
}
