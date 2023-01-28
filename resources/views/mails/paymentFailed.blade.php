@component('mail::message')

Dear {{ $participant->firstName }},

Your payment has failed, please try again using the previously provided link.

Incase your payment has been withdrawn from your bankaccount and you are still receiving this email, please contact us.

Contact us via the mail: or via WhatsApp: <a href="https://wa.me/+31624827777" target="_blank">+31 6 24827777</a>

Your payment-ID: {{ $payment->mollie_transaction_id }}

Thanks in advance!

Kind regards,

Salve Mundi <br>
Rachelsmolen 1 <br>
5612 MA Eindhoven<br>
reis@salvemundi.nl<br>
+31 6 24827777
@endcomponent
