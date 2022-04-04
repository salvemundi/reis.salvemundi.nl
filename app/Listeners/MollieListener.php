<?php
namespace App\Listeners;

use Laravel\Cashier\Events\OrderPaymentPaid;
use Illuminate\Support\Facades\Log;

class ProcessPayment {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param   OrderPaymentPaid  $event
     * @return void
     */
    public function handle(OrderPaymentPaid $event) {
        $participant = $event->payments->owner;
        Log::info($participant);
    }
}
