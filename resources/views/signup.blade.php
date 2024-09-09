@extends('layouts.guapp')
@section('content')

<div class="container">
    @if($checkSignUp)
        <div class="row justify-content-center">
            <div class="col-auto col-lg-6 col-12 pl-5">
                <h1 class="display-5">Fontys ICT gaat internationaal!</h1>
                <div>
                    <b>Datum:</b> 19 tot 23 oktober 2024
                    <br><b>Geschatte Kosten:</b> € 100 - € 140
                </div>
                <ul>
                    <li>
                        Verken de wereld met Salve Mundi
                    </li>
                    <li>
                        Een reis die je nooit zal vergeten
                    </li>
                    <li>
                        Wij regelen het vervoer, de accommodatie en leuke activiteiten!
                    </li>
                    <li>
                        Waar wacht je op?! Schrijf je in!
                    </li>
                </ul>
                <div class="videoWrapper my-3">
                    <iframe class="iframeStyle" width="100%" height="100%"
                        src="https://www.youtube.com/embed/F6E4hGAtBR4" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>

            <div class="col-lg-6 px-md-5 mb-3">
                <div class="box h-100 px-md-5 px-4 py-3 p-auto">
                    <h2 class="mt-3 text-center">Wil je mee? <br> <b>Schrijf je in!</b></h2>
                    Als jij je inschrijft kunnen we niet direct een plek garanderen. Er zijn een limiet aantal plekken beschikbaar, Dus claim je plekje snel!
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

                            @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @endif

                            <label for="firstName" class="form-label">Voornaam</label>
                            <input type="text"
                                class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}"
                                value="{{ old('firstName') }}" name="firstName" id="firstName"
                                placeholder="Voornaam">

                            <label for="insertion" class="form-label">Tussenvoegsel</label>
                            <input type="text"
                                class="form-control{{ $errors->has('insertion') ? ' is-invalid' : '' }}"
                                value="{{ old('insertion') }}" name="insertion" id="insertion"
                                placeholder="Tussenvoegsel">

                            <label for="lastName" class="form-label">Achternaam</label>
                            <input type="text"
                                class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}"
                                value="{{ old('lastName') }}" name="lastName" id="lastName"
                                placeholder="Achternaam">

                            <label for="email" class="form-label">Email</label>
                            <input type="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                value="{{ old('email') }}" name="email" id="email"
                                placeholder="name@example.com">

                            <label for="phoneNumber" class="form-label">Telefoonnummer</label>
                            <input type="text" minlength="10" maxlength="15"
                                class="form-control{{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                max="15" value="{{ old('phoneNumber') }}" name="phoneNumber"
                                id="phoneNumber" placeholder="0612345678">

                            <div class="form-check mt-2">
                                <input class="form-check-input" name="cbx" type="checkbox" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ik accepteer de <a href="{{ asset('storage/documents/algemenevoorwaarden.pdf') }}" download> Algemene voorwaarden</a>
                                </label>
                            </div>

                            <button class="btn btn-primary my-3 w-100" type="submit">Sign up!</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 addMarginBottom">
                <div class="timer d-flex h-100 pt-3">
                    <div class="container my-auto">
                        <h1 id="headline">Volgende reis:</h1>
                        <div id="countdown">
                            <ul class="ps-0">
                                <li><span id="days"></span>Dagen</li>
                                <li><span id="hours"></span>Uren</li>
                                <li><span id="minutes"></span>Minuten</li>
                                <li><span id="seconds"></span>Seconden</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    @else
        <div class="row justify-content-center">
            <div class="col-auto col-md-6 col-12 pl-5">
                <h1 class="display-5">Fontys ICT gaat international!</h1>
                <div>
                    <b>Date:</b> 19 tot 23 oktober 2024
                    <br><b>Geschatte Kosten:</b> € 100 - € 140
                </div>
                <ul>
                    <li>
                        Verken de wereld met Salve Mundi
                    </li>
                    <li>
                        Een reis die je nooit zal vergeten
                    </li>
                    <li>
                        Wij regelen het vervoer, de accommodatie en leuke activiteiten!
                    </li>
                    <li>
                        Waar wacht je op?! Schrijf je in!
                    </li>
                </ul>
            </div>

            <div class="m-auto col-md-6 px-md-5 text-left">
                <h2 class="mt-3 text-center">Wil je mee? <br> <b>Schrijf je in!</b></h2>
                De inschrijvingen gaan vandaag om 14:00 open, zorg dus dat je klaar staat! Je kan je dan hier inschrijven.
            </div>

            <div class="col-12 col-md-6 addMarginBottom">
                <div class="timer d-flex h-100 pt-3">
                    <div class="container my-auto">
                        <h1 id="headline">Next trip:</h1>
                        <div id="countdown">
                            <ul class="ps-0">
                                <li><span id="days"></span>Dagen</li>
                                <li><span id="hours"></span>Uren</li>
                                <li><span id="minutes"></span>Minuten</li>
                                <li><span id="seconds"></span>Seconden</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="videoWrapper">
                    <iframe class="iframeStyle" width="100%" height="100%"
                        src="https://www.youtube.com/embed/F6E4hGAtBR4" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12 col-md-6 px-md-5 my-4">
            <h3>Wat kan ik verwachten van de reis commissie?</h3>
                De Reiscommissie organiseert jaarlijks twee avontuurlijke reizen: een zomerreis en een winterreis. Onze zomerreis strekt zich meestal uit over 5 dagen met 4 overnachtingen in een bruisende, bekende stad. Voor de winterreis kiezen we vaak voor een weekendje weg, waarbij we juist de charme van kleinere steden verkennen.
                Tijdens deze reizen bieden we een gevarieerd activiteitenprogramma aan, waarvoor je je van tevoren kunt inschrijven. Denk aan alles, van gezellige pubcrawls tot culturele museumbezoeken en sfeervolle boottochten tot spannende F1-circuitervaringen! We streven naar een perfecte balans tussen georganiseerde activiteiten en vrije tijd.
                Geen stress! Wij regelen alles, van de vlucht en het vervoer tot het verblijf en de activiteiten. Daarnaast voorzien we je van nuttige informatie over de stad die we bezoeken, van must-see bezienswaardigheden tot handige OV-details!
                Wacht niet langer en schrijf je nu in om samen met Salve Mundi de wereld te verkennen!        </div>
        <div class="col-12 col-md-6 px-md-5 my-4">
            <h3>Hoe was onze vorige Reis</h3>
            Met onze laatste reis hebben we Barcelona verkend! We hebben genoten van de zon in combinatie met leuke activiteiten zoals padellen, en crazy 88 en ng veel meer leuke dingen!
            In onze vrije tijd hebben we vooral genoten van de Spaanse keuken en de gezellige sfeer in de stad. Kortom, het was een onvergetelijke reis!
        </div>
</div>

</div>
@endsection

<script>
    (function () {
        const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;

        //I'm adding this section so I don't have to keep updating this pen every year :-)
        //remove this if you don't need it
        let today = new Date(),
            dd = String(today.getDate()).padStart(2, "0"),
            mm = String(today.getMonth() + 1).padStart(2, "0"),
            yyyy = today.getFullYear(),
            nextYear = yyyy + 1,
            dayMonth = "10/19/",
            birthday = dayMonth + yyyy;

        today = mm + "/" + dd + "/" + yyyy;
        if (today > birthday) {
            birthday = dayMonth + nextYear;
        }
        //end

        const countDown = new Date(birthday).getTime(),
            x = setInterval(function () {

                const now = new Date().getTime(),
                    distance = countDown - now;

                document.getElementById("days").innerText = Math.floor(distance / (day)),
                    document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
                    document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
                    document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

                //do something later when date is reached
                if (distance < 0) {
                    document.getElementById("headline").innerText = "It's my birthday!";
                    document.getElementById("countdown").style.display = "none";
                    document.getElementById("content").style.display = "block";
                    clearInterval(x);
                }
                //seconds
            }, 0)
    }());

</script>
