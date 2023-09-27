@component('mail::message')
<p>
Dear {{ $participant->firstName }},
</p>

<p>
Your payment has been received in good order.
Thank you for registering for the trip!
</p>

<p>
You can find the QR-code for check-in in the attachments of this email!
</p>

@if($participant->activities != null)

<p>
The activities you registered for are:<br>
</p>

@component('mail::table')

    | Activity       | Description   | Price  |
    | -------------  |:-------------:| --------:|
    @foreach($participant->activities as $activity)
    | {{$activity->name}} | {{ $activity->description }} | €{{$activity->price}} |
    @endforeach
@endcomponent
@endif
<p>
For more news and updates: https://reis.salvemundi.nl/blogs
</p>

<p>
Kind regards,
</p>

Salve Mundi <br>
Rachelsmolen 1 <br>
5612 MA Eindhoven<br>
reis@salvemundi.nl<br>
+31 6 24827777
@endcomponent
