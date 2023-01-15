@extends('layouts.guapp')
@section('content')
  <div class="container">
        <div class="textBox">
            <svg class="responses" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>
                <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>
            </svg>
            <h1 class="text-center">Down payment has failed!</h1>
            <p style="white-space: pre-line">
                Please contact us via <a href="mailto:ict@salvemundi.nl">ict@salvemundi.nl</a>
            </p>
            <div class="center">
                <a class="btn btn-primary w-50" href="{{ env('APP_URL') }}">Back</a>
            </div>
            <br>
        </div>
  </div>
@endsection
