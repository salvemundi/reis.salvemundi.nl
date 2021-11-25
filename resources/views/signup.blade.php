@extends('layouts.guapp')
@section('content')
{{-- <img src="{{ asset("images/logo.svg") }}" class="samuLogo"/> --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-auto col-md-6 col-12 pl-5">
            <h1 class="display-5">Een <b class="purple">intro</b> die je niet kan missen en nooit zal vergeten.</h1>
            <p>
                <ul>
                    <li>
                        Avontuur en teambuilding
                    </li>
                    <li>
                        Alcohol en bier (18+) & frisdrank te koop
                    </li>
                    <li>
                        Lunch & avond eten worden voor gezorgd
                    </li>
                </ul>
            </p>
        <div class="box-purple">
            <b>Datum:</b> 22 augustus - 26 augustus <br><b>Kosten:</b> 90 euro
        </div>
        </div>
        <div class="col-md-6 px-md-5">
            <div class="box px-md-5 py-3">
                <h2 class="mt-3">Kom je mee op <b class="purple">intro</b>? <br> <b>Schrijf je hier in</b></h2>

                <div class="mb-3">
                    <form action="/inschrijven" method="post">
                        @csrf

                        @if(session()->has('message'))
                            <div class="alert alert-primary">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        @if(session()->has('warning'))
                            <div class="alert alert-danger">
                                {{ session()->get('warning') }}
                            </div>
                        @endif

                        <label for="firstName" class="form-label">Voornaam</label>
                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Voornaam">

                        <label for="insertion" class="form-label">Tussenvoegsel</label>
                        <input type="text" class="form-control" name="insertion" id="insertion" placeholder="Tussenvoegsel">

                        <label for="lastName" class="form-label">Achternaam</label>
                        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Achternaam">

                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                        <button class="btn btn-primary my-3 w-100" type="submit">Inschrijven</button>
                    </form>
                </div>
            </div>
        </div>

        <h2 class="display-3 mt-3">Salve Mundi Introductie</h2>
            <p>
                Salve Mundi organiseert jaarlijks een introductieweek: De FHICT-introductie. Het is een week vol avontuur en teambuilding in Eindhoven. Zo leer je ook de stad beter kennen. Salve Mundi is druk bezig geweest om dit allemaal mogelijk te maken voor de nieuwe studenten dit jaar. Omdat er rekening gehouden is met verschillende scenario’s kunnen wij ook nu een leuke introductie voor jullie neerzetten. De introductie vindt plaats van dinsdag 22 augustus tot en met donderdag 26 augustus. De introductie kost 40 euro. Houd na het inschrijven je mail in de gaten voor updates, je zult later namelijk een mail ontvangen met daarin de betalingsdetails en aanvullende informatie!
            </p>
            <p>
                De introductie duurt 3 dagen. Op de locatie is een grote evenementenzaal met bar waar zowel alcohol (18+) als frisdrank verkocht zal worden door middel van consumptiebonnen. De locatie bevindt zich bij een bosrand en een mooi open veld. Genoeg ruimte voor activiteiten dus!
            </p>
            <h4>
                Wat hebben wij nu voor jullie georganiseerd?
            </h4>
            <p>
                Op dinsdag hebben wij een dag voor jullie gepland met spellen, een pub quiz en levend stratego. ’s Avonds zal er nog een afterparty gegeven worden.
            </p>
            <p>
                Op woensdag is de Fontys dag. Je wordt om 10:00 verwacht op de Fontys Rachelsmolen. ’s Middags hebben wij weer een middagprogramma voor jullie met daarin bijvoorbeeld de crazy88. ’s Avonds is er weer een vet feest voor jullie.
            </p>
            <p>
                Op donderdag hebben we weer een middagprogramma voor jullie met daarin bijvoorbeeld zeepvoetbal en het moordspel. In de namiddag is er een waterpongtoernooi voor jullie. ’s Avonds hebben we weer een vet feest voor jullie gepland.
            </p>
            <p>
                Lunch en avondeten wordt door ons geregeld op alle drie de dagen.
            </p>
            <p>
                Wij hopen jullie allemaal eind augustus te zien! Tot dan!
            </p>
            <p>
                Voor overige vragen neem per mail contact op met de intro commissie: <a  href="mailto:intro@salvemundi.nl">intro@salvemundi.nl</a>
            </p>
            <p>
                Voor overige vragen neem per mail of whatsapp contact op met de intro commissie: <a  href="mailto:intro@salvemundi.nl">intro@salvemundi.nl</a> of <a href="tel:+31 6 24827777">+31 6 24827777</a>
            </p>

    </div>
</div>
@endsection
