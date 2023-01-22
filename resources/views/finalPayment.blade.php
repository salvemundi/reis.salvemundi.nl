@extends('layouts.guapp')
@section('content')
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

        <form action="/restbetaling/{{ $confirmationToken->id }}" method="post" enctype="multipart/form-data">
            @csrf
            <br>
            <h2 class="h2">Check your activities!</h2>
            <input type="hidden" name="uid" id="uid" value="{{ $confirmationToken->participant->id }}">
            <input type="hidden" name="confirmation" id="confirmation" value="1">
            <label for="activities">Travel and stay price: €{{ Setting::where('name','FinalPaymentAmount')->first()->value }}</label>
            <br>
            <label for="activities">Options you have chosen before:</label>
            @foreach($activities as $activity)
                <p class="form-check-label">
                    {{ $activity->name }}: price: €{{ $activity->price }}
                </p>
            @endforeach

            <label for="activities">Total price: €{{ $totalPaymentAmount }}</label>

            <div class="form-group mb-5">
                <br>
                <input class="btn btn-primary" type="submit" value="Pay">
            </div>
        </form>
    </div>
@endsection
