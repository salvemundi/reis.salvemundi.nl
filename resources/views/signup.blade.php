@extends('layouts.guapp')
@section('content')
{{-- <img src="{{ asset("images/logo.svg") }}" class="samuLogo"/> --}}
<div class="container">
    @if(session()->has('message'))
        <div class="alert alert-primary">
            {{ session()->get('message') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

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
        <div class="box-purple p-3 mb-3">
            <b>Datum:</b> 22 augustus - 26 augustus <br><b>Kosten:</b> 90 euro
        </div>
        </div>
        <div class="col-md-6 px-md-5">
            <div class="box px-md-5 py-3">
                <h2 class="mt-3 text-center">Kom je mee op <b class="purple">intro</b>? <br> <b>Schrijf je hier in!</b></h2>

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
                        <input type="text" class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" value="{{ old('firstName') }}" name="firstName" id="firstName" placeholder="Voornaam">
                        <label for="insertion" class="form-label">Tussenvoegsel</label>
                        <input type="text" class="form-control{{ $errors->has('insertion') ? ' is-invalid' : '' }}" value="{{ old('insertion') }}" name="insertion" id="insertion" placeholder="Tussenvoegsel">

                        <label for="lastName" class="form-label">Achternaam</label>
                        <input type="text" class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" value="{{ old('lastName') }}" name="lastName" id="lastName" placeholder="Achternaam">

                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="email" id="email" placeholder="name@example.com">

                        <button data-bs-toggle="tooltip" data-bs-placement="right" title="Tooltip on right" class="btn btn-primary my-3 w-100" type="submit">Inschrijven</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="imgSlider my-5 mx-auto" id="imgSlider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1}'>
            <div>
                <img class="imgIndex" src="images/introFotos/Intro2021-080.jpg">
            </div>
            <div>
                <img class="imgIndex" src="images/introFotos/Intro2021-101.jpg">
            </div>
            <div>
                <img class="imgIndex" src="images/introFotos/Intro2021-143.jpg">
            </div>
            <div>
                <img class="imgIndex" src="images/introFotos/Intro2021-193.jpg">
            </div>
        </div>
        <script>
            // $('.imgSlider').slick();
        </script>
        <hr class="hr">

        <div class="col-12 col-md-6 px-md-5 my-4">
            <h3>Wat is de introductie?</h3>
            Salve Mundi organiseert jaarlijks een introductieweek: De FHICT-introductie.<br> Het is een week vol avontuur en teambuilding in Eindhoven. Zo leer je ook de stad beter kennen.
            Salve Mundi is druk bezig geweest om dit allemaal mogelijk te maken voor de nieuwe studenten dit jaar.<br><br>
            Houd na het inschrijven je mail in de gaten voor updates, je zult later namelijk een mail ontvangen met daarin de betalingsdetails en aanvullende informatie!<br>
            De introductie duurt 5 dagen. Op de locatie is een grote evenementenzaal met bar waar zowel alcohol (18+) als frisdrank verkocht zal worden door middel van consumptiebonnen. De locatie bevindt zich bij een bosrand en een mooi open veld. Genoeg ruimte voor activiteiten dus.<br>
        </div>
        <div class="col-12 col-md-6 px-md-5 my-4">
            <h3>Wat hebben wij nu voor jullie georganiseerd?</h3>
            De introductie van Salve Mundi zal bestaan uit 5 dagen vol informatie, spelletjes en te gekke feesten op onze vette intro locatie.<br> De maandag zal in het teken staan van inchecken, algemene informatie en een dik feest om de introductie week in te luiden. Dit feest zal georganiseerd worden in samenwerking met UNIQCARTE.<br>
            Op de dinsdag hebben we een dag vol spelletjes georganiseerd, om je nieuwe studiegenoten beter te leren kennen. Ook deze dag zal afgesloten worden met een te gekke afterparty.<br>
            Woensdagochtend zullen we naar Fontys vertrekken en in de middag worden er verschillende activiteiten georganiseerd, waaronder een Crazy88.<br>
            Op donderdag gaan we richting Tilburg voor het Purple Festival, hier zullen we de hele dag lekker gaan feesten, relaxen en genieten voordat we 's avonds de dag afsluiten met een dikke afterparty bij ons op de intro locatie.<br>
            Vrijdag staat helaas in het teken van uitchecken en vertrekken, maar wij hopen dat jullie dan vol goede moed aan de opleiding gaan beginnen.
            Tijdens de introductie zal er door ons op 3 van de 5 dagen lunch en avondeten worden geregeld. Tijdens Purple Festival zal er eigen eten geregeld moeten worden en vrijdag zal je voor het middageten alweer thuis zijn.<br>
        </div>
    </div>
</div>
@endsection
