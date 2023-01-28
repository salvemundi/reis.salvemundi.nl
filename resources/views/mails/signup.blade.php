@component('mail::message')

Dear {{ $participant->firstName }},

Thank you for registering for the Salve Mundi trip!

Soon you will receive more information about the trip by email.

We do ask you to verify your email via the following link:

{{ env('APP_URL') }}inschrijven/verify/{{ $verificationToken->id }}

Kind regards,

Salve Mundi <br>
Rachelsmolen 1 <br>
5612 MA Eindhoven<br>
reis@salvemundi.nl<br>
+31 6 24827777
@endcomponent
