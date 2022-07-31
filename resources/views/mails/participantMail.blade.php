@component('mail::message')

Beste {{ $participant->firstName }},

{!! nl2br($konttent) !!}

@if(!$confirmationToken){
    betalingslink: {{ env('APP_URL') }}inschrijven/betalen/{{ $confirmationToken->id }}
}

Met vriendelijke groet,

Salve Mundi <br>
Rachelsmolen 1 <br>
5612 MA Eindhoven
@endcomponent
