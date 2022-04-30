<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mollie\Api\Exceptions\ApiException;

class WebhookController extends Controller
{
    private $mollie;

    public function __construct() {
        $controller = new PaymentController();
        $this->mollie = $controller->createMollieInstance();
    }

    public function handle(Request $request) {
        if(!$request->has('id')) {
            return;
        }
        try {
            $payment = $this->mollie->payments->get($request->input('id'));

            if ($payment->isPaid() && ! $payment->hasRefunds() && ! $payment->hasChargebacks()) {
                /*
                 * The payment is paid and isn't refunded or charged back.
                 * At this point you'd probably want to start the process of delivering the product to the customer.
                 */
                Log::info("doihgosi");
            } elseif ($payment->isOpen()) {
                /*
                 * The payment is open.
                 */
            } elseif ($payment->isPending()) {
                /*
                 * The payment is pending.
                 */
            } elseif ($payment->isFailed()) {
                /*
                 * The payment has failed.
                 */
            } elseif ($payment->isExpired()) {
                /*
                 * The payment is expired.
                 */
            } elseif ($payment->isCanceled()) {
                /*
                 * The payment has been canceled.
                 */
            } elseif ($payment->hasRefunds()) {
                /*
                 * The payment has been (partially) refunded.
                 * The status of the payment is still "paid"
                 */
            } elseif ($payment->hasChargebacks()) {
                /*
                 * The payment has been (partially) charged back.
                 * The status of the payment is still "paid"
                 */
            }
        } catch (ApiException $e) {
            return response()->view('errors.500',['e' => $e],500);
        }
    }
}
