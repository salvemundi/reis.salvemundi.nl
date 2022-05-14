<?php

namespace App\Http\Controllers;

use App\Models\ConfirmationToken;
use App\Models\Participant;
use \Mollie\Api\MollieApiClient;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use \Mollie\Api\Exceptions\ApiException;

class PaymentController extends Controller
{
    public function payForIntro($token) {
        $confirmationToken = ConfirmationToken::findOrFail($token);
        try{
            $mollie = $this->createMollieInstance();
            $paymentObject = $this->createPaymentEntry($confirmationToken->participant);
            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => "90.00"
                ],
                "description" => "Introductie ". Date("Y"),
                "redirectUrl" => route('payment.success'),
                "webhookUrl"  => route('webhooks.mollie'),
                "metadata" => [
                    "payment_id" => $paymentObject->id,
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

    public function createMollieInstance() {
        $mollie = new MollieApiClient();
        $mollie->setApiKey(env('MOLLIE_KEY'));
        return $mollie;
    }

    private function createPaymentEntry(Participant $participant) {
        $payment = new Payment;
        $payment->save();
        $payment->participant()->associate($participant)->save();
        return $payment;
    }
}
