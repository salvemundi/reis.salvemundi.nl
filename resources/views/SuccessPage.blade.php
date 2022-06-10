@extends('layouts.guapp')
@section('content')
  <div class="container">
        <div class="justify-content-center">
            <div class="textBox justify-content-center">
                <svg class="responses" style="margin: auto; display: block;" class="responses" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                    <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                    <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                </svg>
                <h1 class="text-center">Je hebt betaald!</h1>
                <p>
                    Bedankt voor het betalen! <br>Tot op de intro!<br>
                </p>
                <div class="center mb-3">
                    <a class="btn btn-primary center" href="https://salvemundi.nl/">Salve Mundi website</a>
                </div>
                <div class="center mb-3">
                    <img class="verify-img" src="/images/verify.jpg" alt="">
                </div>
            </div>
        </div>
  </div>
@endsection
