<?php

namespace App\Http\Controllers;

use App\Models\ConfirmationToken;
use \Laravel\Cashier\Charge\ChargeItemBuilder;
use \Laravel\Cashier\Http\RedirectToCheckoutResponse;

class PaymentController extends Controller
{
    public function payForIntro($token) {
        $participantController = new ParticipantController();
        $tokenFound = ConfirmationToken::find($token);

        $item = new ChargeItemBuilder($tokenFound->participant);
        $item->unitPrice(money(9000,'EUR')); //90 EUR
        $item->description('Introductie inschrijving');
        $chargeItem = $item->make();

        $result = $tokenFound->participant->newCharge()
            ->addItem($chargeItem)
            ->create();

        if(is_a($result, RedirectToCheckoutResponse::class)) {
            return $result;
        }

        return redirect('/')->with('status', 'Bedankt voor het inschrijven voor de introductie!');
    }
}
