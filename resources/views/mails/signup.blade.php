@component('mail::message')

Beste {{ $participant->firstName }},

Bedankt voor het inschrijven voor de Salve Mundi reis!

Binnenkort ontvang je per mail meer informatie over de reis.

Wel vragen we je om je mail te verifiëren via de volgende link:

{{ env('APP_URL') }}inschrijven/verify/{{ $verificationToken->id }}

Alvast bedankt!

Met vriendelijke groet,

Salve Mundi <br>
Rachelsmolen 1 <br>
5612 MA Eindhoven<br>
reis@salvemundi.nl<br>
+31 6 24827777
@endcomponent
