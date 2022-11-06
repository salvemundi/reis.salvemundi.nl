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

    <form action="/inschrijven/betalen/{{ $confirmationToken->id }}" method="post" enctype="multipart/form-data">
        @csrf
        <br>
        <h2 class="h2">Graag de aanvullende informatie invullen</h2>
        <input type="hidden" name="uid" id="uid" value="{{ $confirmationToken->participant->id }}">
        <input type="hidden" name="confirmation" id="confirmation" value="1">
        <div class="form-group">
            <label for="voornaam">Voornaam*</label>
            <input class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" name="firstName" value="{{ $confirmationToken->participant->firstName }}" disabled>
        </div><br>
        @if($confirmationToken->participant->insertion != "" || $confirmationToken->participant->insertion != null)
            <div class="form-group">
                <label for="voornaam">Tussenvoegsel</label>
                <input class="form-control{{ $errors->has('insertion') ? ' is-invalid' : '' }}" name="insertion" value="{{ $confirmationToken->participant->insertion }}" disabled>
            </div><br>
        @endif

        <div class="form-group">
            <label for="voornaam">Achternaam*</label>
            <input class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" name="lastName" value="{{ $confirmationToken->participant->lastName }}" disabled>
        </div><br>

        <div class="form-group">
            <label for="voornaam">Geboortedatum*</label>
            <input class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" value="{{ old('birthday') }}" type="date" id="birthday" name="birthday" placeholder="MM-DD-JJJJ..." onblur="getAge()">
        </div><br>

        <div class="form-group">
            <label for="voornaam">Email*</label>
            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $confirmationToken->participant->email }}" id="email" name="email" placeholder="Email...">
        </div><br>

        <div class="form-group">
            <label for="voornaam">Telefoonnummer*</label>
            <input class="form-control{{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}" value="{{ $confirmationToken->participant->phoneNumber }}" id="phoneNumber" name="phoneNumber" placeholder="Telefoonnummer...">
        </div><br>

        <div class="form-group">
            <label for="voornaam">Allergieën</label>
            <textarea class="form-control{{ $errors->has('medicalIssues') ? ' is-invalid' : '' }}" value="{{{ old('medicalIssues') }}}" type="textarea" id="medicalIssues" name="medicalIssues" placeholder="Allergieën..."></textarea>
        </div><br>

        <div class="form-group">
            <label for="voornaam">Bijzonderheden</label>
            <textarea class="form-control{{ $errors->has('specials') ? ' is-invalid' : '' }}" value="{{{ old('specials') }}}" type="textarea" id="specials" name="specials" placeholder="Bijzonderheden..."></textarea>
        </div><br>

        <div class="form-group mb-5">
            <br>
            <input class="btn btn-primary" type="submit" value="Betalen">
        </div>
    </form>
</div>
@endsection
