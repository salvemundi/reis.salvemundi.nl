<?php

namespace App\Http\Controllers;

use App\Enums\PaymentTypes;
use App\Enums\Roles;
use App\Models\Activity;
use App\Models\ConfirmationToken;
use App\Models\Participant;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use \Mollie\Api\MollieApiClient;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use App\Enums\PaymentStatus;
use \Mollie\Api\Exceptions\ApiException;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private VerificationController $verificationController;

    public function __construct() {
        $this->verificationController = new VerificationController();
    }

    public function payForReis(string $token, int $amount, PaymentTypes $paymentType = null): Response|RedirectResponse
    {
        $confirmationToken = ConfirmationToken::findOrFail($token);
        $amountWithDecimal = str_replace(",", "", number_format($amount, 2));
        try{
            $mollie = $this->createMollieInstance();
            $paymentObject = $this->createPaymentEntry($confirmationToken->participant, $paymentType);
            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => "$amountWithDecimal"
                ],
                "description" => "Reis ". Date("Y"),
                "redirectUrl" => route('payment.success', ['userId' => $confirmationToken->participant->id]),
                "webhookUrl"  => env('NGROK_LINK') ?? route('webhooks.mollie'),
                "metadata" => [
                    "payment_id" => $paymentObject->id,
                    "paymentType" => $paymentType->value ?? PaymentTypes::DownPayment,
                    "confirmationTokenId" => $confirmationToken->id
                ],
            ]);
            $paymentObject->mollie_transaction_id = $payment->id;
            $paymentObject->save();
            return redirect()->away($payment->getCheckoutUrl(), 303);
        } catch (ApiException $e) {
            Log::error($e);
            return response()->view('errors.500',['e' => $e],500);
        }
    }

    public function createMollieInstance(): MollieApiClient
    {
        $mollie = new MollieApiClient();
        $mollie->setApiKey(env('MOLLIE_KEY'));
        return $mollie;
    }

    public function returnSuccessPage(Request $request) {
        try {
            $participant = Participant::findOrFail($request->userId);
            $participant->latestPayment = $participant->payments()->latest()->first();

            if ($participant != null) {
                if ($participant->latestPayment != null || $participant->latestPayment->paymentStatus == PaymentStatus::paid) {
                    return view('SuccessPage')->with(['paymentType' => $participant->latestPayment->paymentType]);
                }
            return view('paymentFailed');
            }
        }
        catch (\Exception $e) {
            Log::error($e);
            return view('paymentFailed');
        }
    }
    /**
     * @var $verifiedParticipants Participant[]
     * @var $Participant Participant
     * @return Collection|null
     */
    public function getAllPaidUsers(): Collection|null {
        $userArr = [];
        $verifiedParticipants = $this->verificationController->getVerifiedParticipants();
        /** @var $verifiedParticipants Participant[] */
        foreach($verifiedParticipants as $participant) {
            if($participant->hasCompletedAllPayments() && $participant->role == Roles::participant()->value && !$participant->isOnReserveList) {
                $userArr[] = $participant;
            }
        }
        return collect($userArr)->unique('id');
    }

    public function getAllNonPaidUsers(): Collection
    {
        $verifiedParticipants = $this->verificationController->getVerifiedParticipants();
        $userArr = [];
        /** @var $verifiedParticipants Participant[] */
        foreach($verifiedParticipants as $participant) {
            if (!$participant->hasCompletedAllPayments() && $participant->role == Roles::participant()->value && !$participant->isOnReserveList) {
                $userArr[] = $participant;
            }
        }
        return collect($userArr)->unique('id');
    }

    public function checkIfParticipantPaid(Participant $participant): bool {
        $participant->latestPayment = $participant->payments()->latest()->first();

        if ($participant->latestPayment != null) {
            if($participant->latestPayment->paymentStatus == PaymentStatus::paid) {
                return true;
            }
        }
        return false;
    }

    public function calculateFinalPrice(ConfirmationToken $confirmationToken): float
    {
        $participant = $confirmationToken->participant;

        if ($participant->hasCompletedDownPayment()) {
            (float)$basePrice = Setting::where('name', 'FinalPaymentAmount')->first()->value;
            /** @var  $activity activity */
            foreach ($participant->activities as $activity) {
                $basePrice += (float)$activity->price;
            }
            return $basePrice;
        } else {
            return (float)Setting::where('name', 'Aanbetaling')->first()->value;
        }
    }

    private function createPaymentEntry(Participant $participant, PaymentTypes $paymentType = null): Payment
    {
        $payment = new Payment;
        $payment->save();
        $payment->participant()->associate($participant)->save();
        $payment->paymentType = $paymentType->value ?? PaymentTypes::DownPayment;
        return $payment;
    }
}
