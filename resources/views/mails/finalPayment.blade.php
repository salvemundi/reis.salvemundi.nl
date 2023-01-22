@component('mail::message')
Dear {{ $participant->firstName }},

You can now complete your registration by clicking on this link!

{{ env('APP_URL') }}reisbetaling/{{ $confirmationToken->id }}

Sincerely,

Salve Mundi <br>
Rachelsmolen 1 <br>
5612 MA Eindhoven<br>
reis@salvemundi.nl<br>
+31 6 24827777
@endcomponent
