@component('mail::message')

Beste {{ $participant->firstName }},

Bedankt voor het inschrijven voor de Salve Mundi introductie!

Binnenkort ontvang je per mail meer informatie over de introductie.

Wel vragen we je om je mail te verifiëren via de volgende link:

{{ env('APP_URL') }}inschrijven/verify/{{ $verificationToken->id }}

Alvast bedankt!

Met vriendelijke groet,

Salve Mundi <br>
RachelsMolen 1 <br>
5612 MA Eindhoven
@endcomponent
