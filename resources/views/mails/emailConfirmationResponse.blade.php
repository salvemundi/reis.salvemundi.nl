@component('mail::message')
Beste {{ $participant->firstName }},

Je kan nu je inschrijving afronden door op deze link te klikken en de benodigde informatie in te vullen!

{{ env('APP_URL') }}inschrijven/betalen/{{ $confirmationToken->id }}

Met vriendelijke groet,

Salve Mundi <br>
RachelsMolen 1 <br>
5612 MA Eindhoven
@endcomponent
