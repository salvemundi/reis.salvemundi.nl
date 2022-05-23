@extends('layouts.guapp')
@section('content')
{{-- <img src="{{ asset("images/logo.svg") }}" class="samuLogo"/> --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-auto col-md-6 col-12 pl-5">
            <h1 class="display-5">Een <b class="purple">Festival</b> die je niet kan missen en nooit zal vergeten.</h1>
            <p>
                <ul>
                    Hier wat informatie over waarom je kan inscrhijven en hoe je informatie ontvangt?
                </ul>
            </p>
        <div class="box-purple p-3 mb-3">
            <b>Datum:</b> 25 augustus 14:00 - 23:00
        </div>
        </div>
        <div class="col-md-6 px-md-5">
            <div class="box px-md-5 py-3">
                <h2 class="mt-3 text-center">Kom je mee naar <b class="purple">Purple Festival</b>? <br> <b>Schrijf je hier in!</b></h2>

                <div class="mb-3">
                    <form action="/purpleInschrijven" method="post">
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

                        <label for="studentNumber" class="form-label">Studentnummer:</label>
                        <input type="number" name="studentNumber" id="studentNumber" placeholder="Studentnummer">

                        <button class="btn btn-primary my-3 w-100" type="submit">Inschrijven</button>
                    </form>
                </div>
            </div>
        </div>


</div>
@endsection
