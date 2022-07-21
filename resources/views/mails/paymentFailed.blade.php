@component('mail::message')

Beste {{ $participant->firstName }},

Helaas hebben we dit keer slecht nieuws. We zien dat je betaling niet goed is ontvangen bij onze betalings provider.
Probeer het later opnieuw!

Mocht het je meerdere keren niet lukken of is het geld wel afgeschreven maar ontvang je alsnog deze mail?

Neem dan contact op met per mail: info@salvemundi.nl of via WhatsApp: <a href="https://wa.me/+31624827777" target="_blank">+31 6 24827777</a>

Jouw betalings ID: {{ $payment->mollie_transaction_id }}

Alvast bedankt!

Met vriendelijke groet,

Salve Mundi <br>
Rachelsmolen 1 <br>
5612 MA Eindhoven
@endcomponent
