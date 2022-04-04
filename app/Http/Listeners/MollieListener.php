<?php
namespace Laravel\Cashier\Events;

use Illuminate\Queue\SerializesModels;
use Laravel\Cashier\Order\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailPaymentSucceeded;
use Mollie\Api\Resources\Payment;

class ProcessPayment {
    use SerializesModels;

    /**
     * @var Payment
     */
    public $payment;

    /**
     * The order created for this first payment.
     *
     * @var Order
     */
    public $order;

    public function __construct($payment, $order)
    {
        $this->payment = $payment;
        $this->order = $order;
    }

    public function OrderPaymentPaid() {
        $email = $this->payment->owner->email;
        Mail::to($email)
            ->send(new emailPaymentSucceeded($this->payment->owner));
    }

    public function FirstPaymentPaid() {
        $email = $this->payment->owner->email;
        Mail::to($email)
            ->send(new emailPaymentSucceeded($this->payment->owner));
    }
}
