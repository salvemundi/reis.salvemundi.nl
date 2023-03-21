@component('mail::message')
Dear {{ $participant->firstName }},

@if($participant->hasCompletedDownPayment())
You now can pay your final payment if you click the link below!
@else
You now can pay your down payment if you click the link below!
@endif

{{ env('APP_URL') }}inschrijven/betalen/{{ $confirmationToken->id }}

Kind regards,

Salve Mundi <br>
Rachelsmolen 1 <br>
5612 MA Eindhoven<br>
reis@salvemundi.nl<br>
+31 6 24827777
@endcomponent
