@component('mail::message')
Dear {{ $participant->firstName }},

You now can pay your down payment if you click the link below!

{{ env('APP_URL') }}inschrijven/betalen/{{ $confirmationToken->id }}

Sincerely,

Salve Mundi <br>
Rachelsmolen 1 <br>
5612 MA Eindhoven<br>
reis@salvemundi.nl<br>
+31 6 24827777
@endcomponent
