<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Events\OrderPaymentPaid;
use Illuminate\Support\Facades\Log;

class ProcessPayment
{
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
     * @param  OrderPaymentPaid  $event
     * @return void
     */
    public function handle($event)
    {
        Log::info($event);
    }
}
