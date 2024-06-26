<?php

namespace App\Mail;

use App\Enums\PaymentTypes;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Participant;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;
use Intervention\Image\Facades\Image;

class emailPaymentSucceeded extends Mailable
{
    use Queueable, SerializesModels;

    private PaymentTypes $paymentType;
    private Participant $participant;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Participant $participant, PaymentTypes $paymentType)
    {
        $this->participant = $participant;
        $this->paymentType = $paymentType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch($this->paymentType->value) {
            case(PaymentTypes::DownPayment):
                return $this
                    ->subject("Confirmation of down payment")
                    ->markdown('mails/emailDownPaymentSucceeded', ['participant' => $this->participant]);
            case(PaymentTypes::FinalPayment):
                return $this
                    ->subject("Confirmation of payment")
                    ->attachData((string)Image::canvas(290, 290, "#fff")->insert(base64_decode(DNS2D::getBarcodePNG($this->participant->id, 'QRCODE', 10, 10)))->resizeCanvas(20 * 2, 20 * 2, 'center', true, "#fff")->encode('jpg'), 'qrcode.jpg', [
                        'as' => 'qrcode.jpg',
                        'mime' => 'application/jpg',
                    ])
                    ->markdown('mails/emailPaymentSucceeded', ['participant' => $this->participant]);
        }
    }
}
