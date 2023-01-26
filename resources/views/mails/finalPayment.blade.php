@component('mail::message')
Dear {{ $participant->firstName }},

You can now complete your registration by clicking on this link!
Keep in mind that it is no longer possible to apply or change activities as these have already been booked and/or reserved by the organization.

{{ env('APP_URL') }}inschrijven/betalen/{{ $confirmationToken->id }}

Sincerely,

Salve Mundi <br>
Rachelsmolen 1 <br>
5612 MA Eindhoven<br>
reis@salvemundi.nl<br>
+31 6 24827777
@endcomponent
