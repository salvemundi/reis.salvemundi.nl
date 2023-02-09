@extends('layouts.guapp')
@section('content')
  <div class="container justify-content-center">
        @if($Response)
            <div class="justify-content-center">
                <div class="textBox justify-content-center">
                    <svg class="responses" version="1.1" style="display: block; margin: auto;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                        <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                    </svg>
                    <h1 class="text-center">You are verified!</h1>
                    <p style="text-align: center !important;">
                        Thanks for the signup! <br>Soon you will hear more from us! <br>For more info: <a href="reis.salvemundi.nl">reis.salvemundi.nl</a>
                    </p>
                    <div class="center mb-3">
                        <a class="btn btn-primary center" href="https://salvemundi.nl/">Salve Mundi website</a>
                    </div>
                    <div class="center mb-3">
                        <img class="verify-img" src="/images/verify.jpg" alt="">
                    </div>
                </div>
            </div>
        @else
            <div class="textBox justify-content-center" >
                <svg class="responses justify-content-center"  style="display: block; margin: auto;" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                    <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                    <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>
                    <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>
                </svg>
                <h1 class="text-center">This code is not valid, please contact us!</h1>
                <p style="white-space: pre-line; text-align: center !important;">
                    You can contact us via: <a href="mailto:ict@salvemundi.nl">ict@salvemundi.nl</a>
                    Send your name and the link you have gotten from us.
                    Note: it is also possible that you already verified your email.
                </p>
                <div class="center">
                    <a class="btn btn-primary w-50" href="{{ env('APP_URL') }}">Back</a>
                </div>
            </div>
        @endif
  </div>
@endsection
