@extends('layouts.guapp')
@section('content')

<div class="container">
    @if($checkSignUp)
        <div class="row justify-content-center">
            <div class="col-auto col-lg-6 col-12 pl-5">
                <h1 class="display-5">Fontys ICT gaat internationaal!</h1>
                <div>
                    <b>Datum:</b> 29 april - 5 mei <br><b>Kosten:</b> € 130~
                </div>
                <p>
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
                </p>
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
                    Als jij je inschrijft kunnen we niet direct een plek garanderen. Er zijn een limiet aantal plekken beschikbaar, Dus claim je ticket snel!
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
                    <b>Date:</b> 29 April - 3 May <br><b>Costs:</b> Will be determined
                </div>
                <p>
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
                </p>
            </div>

            <div class="m-auto col-md-6 px-md-5 text-left">
                <h2 class="mt-3 text-center">Wil je mee? <br> <b>Schrijf je in!</b></h2>
                Als jij je inschrijft kunnen we niet direct een plek garanderen. Er zijn een limiet aantal plekken beschikbaar, Dus claim je ticket snel!
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
            De Reiscommissie organiseert elk jaar 2 reizen, een zomerreis, en een winterreis. De zomerreis is vaak 5 dagen, 4 overnachtingen in een grote, bekende en populaire stad. De winterreis is vaak alleen een weekend, en hier proberen we vaak de wat kleinere steden op te zoeken. Tijdens de reis worden er activiteiten georganiseerd waar je je vantevoren voor in kan schrijven. Dit kan vanalles zijn, van pubcrawls tot musea, en boottochten tot F1 circuits! We proberen een goed balans te houden tussen activiteiten en vrije tijd. Ook proberen we alle zorgen weg te nemen, en we regelen dus de vlucht, het vervoer, het verblijf en de activiteiten! We zorgen dat je nuttige informatie hebt over de stad waar we heen gaan, van bezienswaardigheden tot OV informatie! Schrijf je dus nu in, en verken de wereld samen met Salve Mundi!        </div>
        <div class="col-12 col-md-6 px-md-5 my-4">
            <h3>Hoe was onze vorige Reis</h3>
            Op onze vorige zomerreis zijn we naar Budapest gegaan. Hier zijn we verbleven in een hostel dat dicht bij het centrum lag. Ook hebben we voor een hostel gekozen waartet OV (zowel bus,tram als metro) dichtbij lagen, zodat iedereen alle mogelijkheden had om de stad te verkennen! Tijdens de reis, zijn we naar de Hungaroring geweest (het F1 circuit van Hongarije), we zijn naar Sparty geweest (Een feest in een badhuis dat uniek is in de wereld), en we zijn naar de dierentuin van Budapest geweest! Natuurlijk hebben we met zijn allen de stad verkend, en we hebben natuurlijk een hoop onvergetelijke herinneringen gemaakt!    </div>
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
            dayMonth = "10/14/",
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
