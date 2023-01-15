@extends('layouts.guapp')
@section('content')
  <div class="container">
        <div class="justify-content-center">
            <div class="textBox justify-content-center">
                <h1 class="text-center">Your down payment is being processed!</h1>
                <p>
                    Within 10 minutes you will receive an e-mail with your payment status. <br>
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
