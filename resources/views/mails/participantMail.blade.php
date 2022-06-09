@component('mail::message')

Beste {{ $participant->firstName }},

{!! nl2br($konttent) !!}

Met vriendelijke groet,

Salve Mundi <br>
RachelsMolen 1 <br>
5612 MA Eindhoven
@endcomponent
