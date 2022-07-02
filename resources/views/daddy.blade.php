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

    <form action="/inschrijven/ouders/store" method="post" enctype="multipart/form-data">
        @csrf
        <br>
        <h2 class="h2">Graag de aanvullende informatie invullen</h2>
        Hierna krijg je een email met een qr-code, bewaar deze goed want met die qr-code kom je het intro terrein op en af.<br><br>

        <div class="form-group">
            <label for="voornaam">Voornaam*</label>
            <input class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" name="firstName">
        </div><br>
            <div class="form-group">
                <label for="voornaam">Tussenvoegsel</label>
                <input class="form-control{{ $errors->has('insertion') ? ' is-invalid' : '' }}" name="insertion">
            </div><br>

        <div class="form-group">
            <label for="voornaam">Achternaam*</label>
            <input class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" name="lastName">
        </div><br>

        <div class="form-group">
            <label for="voornaam">Email*</label>
            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="Email...">
        </div><br>

        <div class="form-group">
            <label for="voornaam">Geboortedatum*</label>
            <input class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" type="date" id="birthday" name="birthday" placeholder="MM-DD-JJJJ..." onblur="getAge()">
        </div><br>

        <div class="form-group">
            <label for="voornaam">Telefoonnummer*</label>
            <input class="form-control{{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}" id="phoneNumber" name="phoneNumber" placeholder="Telefoonnummer...">
        </div><br>

        <div class="form-group">
            <label for="fontysEmail">Je fontys email adres (als je die niet hebt laat dit veld dan leeg)</label>
            <input class="form-control{{ $errors->has('fontysEmail') ? ' is-invalid' : '' }}" id="fontysEmail" name="fontysEmail" placeholder="123456@student.fontys.nl...">
        </div><br>

        <div class="form-group">
            <label for="voornaam">Allergieën</label>
            <input class="form-control{{ $errors->has('medicalIssues') ? ' is-invalid' : '' }}" value="{{ old('medicalIssues') }}" id="medicalIssues" name="medicalIssues" placeholder="Allergieën...">
        </div><br>

        <div class="form-group">
            <label for="voornaam">Bijzonderheden</label>
            <input class="form-control{{ $errors->has('specials') ? ' is-invalid' : '' }}" value="{{ old('specials') }}" id="specials" name="specials" placeholder="Bijzonderheden...">
        </div><br>

        <h2>We hebben informatie nodig van een contactpersoon voor als er iets met jou gebeurt</h2>

        <label for="VoornaamVoogd">Voornaam contactpersoon*</label>
        <input class="form-control{{ $errors->has('firstNameParent') ? ' is-invalid' : '' }}" value="{{ old('firstNameParent') }}" type="text" id="firstNameParent" name="firstNameParent" placeholder="Voornaam contactpersoon...">

        <br>
        <label for="AchternaamVoogd">Achternaam contactpersoon*</label>
        <input class="form-control{{ $errors->has('lastNameParent') ? ' is-invalid' : '' }}" value="{{ old('lastNameParent') }}" type="text" id="lastNameParent" name="lastNameParent" placeholder="Achternaam contactpersoon...">

        <br>
        <label for="TelefoonnummerVoogd">Telefoonnummer contactpersoon*</label>
        <input class="form-control{{ $errors->has('phoneNumberParent') ? ' is-invalid' : '' }}" value="{{ old('phoneNumberParent') }}" type="text" id="phoneNumberParent" name="phoneNumberParent" placeholder="Telefoonnummer contactpersoon...">

        <div class="form-group mb-5">
            <br>
            <input class="btn btn-primary" type="submit" value="Toevoegen">
        </div>
    </form>
</div>

@endsection
