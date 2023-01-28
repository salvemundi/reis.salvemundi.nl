@component('mail::message')

Dear {{ $participant->firstName }},

{!! nl2br($konttent) !!}

@if(isset($confirmationToken))
Paymentlink:

{{ env('APP_URL') }}inschrijven/betalen/{{ $confirmationToken->id }}
@endif

Kind regards,

Salve Mundi <br>
Rachelsmolen 1 <br>
5612 MA Eindhoven<br>
reis@salvemundi.nl<br>
+31 6 24827777
@endcomponent
