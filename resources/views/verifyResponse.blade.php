@extends('layouts.guapp')
@section('content')
  <div class="container">
      @if($Response)
          <div class="justify-content-center">
              <div class="textBox justify-content-center">
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                      <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                      <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                    </svg>
                  <h1 class="text-center">Je ben geverifieerd!</h1>
                  <p>
                      Bedankt voor het aanmelden! <br>Je zal van ons horen na je examens<br>Voor meer informatie ga naar <a href="intro.salvemundi.nl">intro.salemundi.nl</a>
                  </p>
                  <div class="center mb-3">
                      <img class="verify-img" src="/images/verify.jpg" alt="">
                  </div>
              </div>
          </div>

          <meta http-equiv="refresh" content="5;URL=https://salvemundi.nl/">
      @else
          <div>
              <img class="w-100" src="images\verify.jpg" alt="">
              <div class="textBox">
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                      <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                      <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>
                      <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>
                    </svg>
                  <h1 class="text-center">Deze code is niet valide! Neem contact met ons op!</h1>
                  <p>
                      Je kunt contact met ons op nemen via <a href="mailto:ict@salvemundi.nl">ict@salvemundi.nl</a>
                      Stuur hierbij je naam, en de link die je hebt gekregen.
                  </p>
              </div>
          </div>
          <meta http-equiv="refresh" content="10;URL=https://intro.salvemundi.nl/">
     @endif
  </div>
@endsection
