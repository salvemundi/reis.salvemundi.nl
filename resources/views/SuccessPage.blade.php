@extends('layouts.guapp')
@section('content')
  <div class="container">
        <div class="justify-content-center">
            <div class="textBox justify-content-center">
                @if($paymentType == \App\Enums\PaymentTypes::DownPayment)
                <h1 class="text-center">Your down payment is being processed!</h1>
                @else
                <h1 class="text-center">Your final payment is being processed!</h1>
                @endif
                <p class="d-flex justify-content-center mb-2">
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
