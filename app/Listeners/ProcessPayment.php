<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Events\OrderInvoiceAvailable;
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
     * @param  OrderInvoiceAvailable  $event
     * @return void
     */
    public function handle(OrderInvoiceAvailable $event)
    {
        Log::info($event);
    }
}
