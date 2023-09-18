@extends('layouts.guapp')
@section('content')

<div class="container">
    @if($checkSignUp)
        <div class="row justify-content-center">
            <div class="col-auto col-lg-6 col-12 pl-5">
                <h1 class="display-5">Fontys ICT goes international!</h1>
                <div>
                    <b>Date:</b> 14 - 17 October <br><b>Costs:</b> € 79,63
                </div>
                <p>
                    <ul>
                        <li>
                            Explore the world with Salve Mundi
                        </li>
                        <li>
                            A trip you will never forget
                        </li>
                        <li>
                            We organize the flight, the accommodation and some activities!
                        </li>
                        <li>
                            Every member of a study association of FHICT is able to join this trip.
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
                    <h2 class="mt-3 text-center">Do you want to join the trip? <br> <b>Sign up down below!</b></h2>
                    We can not assure you a ticket for this trip when you register. There are limited amount of tickets available, so I would sign up quick to claim your ticket!
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

                            <label for="firstName" class="form-label">Firstname</label>
                            <input type="text"
                                class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}"
                                value="{{ old('firstName') }}" name="firstName" id="firstName"
                                placeholder="Firstname">

                            <label for="insertion" class="form-label">Insertion</label>
                            <input type="text"
                                class="form-control{{ $errors->has('insertion') ? ' is-invalid' : '' }}"
                                value="{{ old('insertion') }}" name="insertion" id="insertion"
                                placeholder="Insertion">

                            <label for="lastName" class="form-label">Lastname</label>
                            <input type="text"
                                class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}"
                                value="{{ old('lastName') }}" name="lastName" id="lastName"
                                placeholder="Lastname">

                            <label for="email" class="form-label">Email</label>
                            <input type="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                value="{{ old('email') }}" name="email" id="email"
                                placeholder="name@example.com">

                            <label for="phoneNumber" class="form-label">Phonenumber</label>
                            <input type="text" minlength="10" maxlength="15"
                                class="form-control{{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                max="15" value="{{ old('phoneNumber') }}" name="phoneNumber"
                                id="phoneNumber" placeholder="0612345678">

                            <div class="form-check mt-2">
                                <input class="form-check-input" name="cbx" type="checkbox" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    I accept the <a href="{{ asset('storage/documents/algemenevoorwaarden.pdf') }}" download> terms and conditions</a>
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
                        <h1 id="headline">Next trip:</h1>
                        <div id="countdown">
                            <ul class="ps-0">
                                <li><span id="days"></span>Days</li>
                                <li><span id="hours"></span>Hours</li>
                                <li><span id="minutes"></span>Minutes</li>
                                <li><span id="seconds"></span>Seconds</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    @else
        <div class="row justify-content-center">
            <div class="col-auto col-md-6 col-12 pl-5">
                <h1 class="display-5">Fontys ICT goes international!</h1>
                <div>
                    <b>Date:</b> 29 April - 3 May <br><b>Costs:</b> Will be determined
                </div>
                <p>
                    <ul>
                        <li>
                            Explore the world with Salve Mundi
                        </li>
                        <li>
                            A trip you will never forget
                        </li>
                        <li>
                            We organize the flight, the accommodation and some activities!
                        </li>
                        <li>
                            Every member of a study association of FHICT is able to join this trip.
                        </li>
                    </ul>
                </p>
            </div>

            <div class="m-auto col-md-6 px-md-5 text-left">
                <h2><b>Registration will be available on the 11th of January at 12:00.</b></h2>
                 We can not assure you a ticket for this trip when you register. There are limited amount of tickets available, so I would sign up quick to claim your ticket!
                <h4 class="mt-2"><b>Do you want to know where we are going? Check our hints <a
                            href="/blogs">here!</a></b></h4>
            </div>

            <div class="col-12 col-md-6 addMarginBottom">
                <div class="timer d-flex h-100 pt-3">
                    <div class="container my-auto">
                        <h1 id="headline">Next trip:</h1>
                        <div id="countdown">
                            <ul class="ps-0">
                                <li><span id="days"></span>Days</li>
                                <li><span id="hours"></span>Hours</li>
                                <li><span id="minutes"></span>Minutes</li>
                                <li><span id="seconds"></span>Seconds</li>
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
            <h3>What can I expect from this trip?</h3>
            Every year Salve Mundi tries to organize a trip for students of FHICT. The members of the study associations Proxy and IERA are also invited to this trip. During this trip you will see a lot of the city where we are going to, and we will do some activities during this trip. You do not have to worry about a thing. We organized the whole trip, from the airport we are flying from to the hostel in the city that we are going to. During the trip we will have activities and you have free time to fill in yourself. The entire trip takes an average of 5 days.
        </div>
        <div class="col-12 col-md-6 px-md-5 my-4">
            <h3>What we did the previous trip</h3>
            On our last trip, we went to Budapest. In Budapest, we stayed at a hostel which was near the city center, which means the public transport was also really close to us so we could travel the city whenever we felt like it. During this trip, we have done some activities such as going to the Hungaroring (Formula 1 circuit), Sparty (Budapest bath party) and we went to the Budapest Zoo. Furthermore, we have seen a lot of the beautiful city and we had loads of fun being there!        </div>
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
