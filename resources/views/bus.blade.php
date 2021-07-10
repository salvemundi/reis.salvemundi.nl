@extends('layouts.app')
@section('content')

<div class="container center">
    <div class="row">
        <div class="col-md-12">
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
            @if ($busses->count() == 0)
                <form action="/bus/add" method="POST">
                @csrf
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="labelBus mt-1" for="voornaam">Hoeveelheid bussen: </label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control{{ $errors->has('busAmount') ? ' is-invalid' : '' }}" value="{{ old('busAmount') }}" id="busAmount" name="busAmount" placeholder="Aantal bussen...">
                        </div>
                        <div class="col-md-4">
                            <input class="btn btn-primary" type="submit" value="Toevoegen">
                        </div>
                    </div>
                </form>
            @else
                <form action="/bus/reset" method="POST">
                @csrf
                    <div class="card">
                    @if ($differenceParticipantsInBusses > 0)
                        <div class="card-body notEnoughPeople">
                    @else
                        <div class="card-body enoughPeople">
                    @endif
                            <b>Totaal aantal mensen:</b> {{ $allParticipants }}
                            <br>
                            <b>Aantal mensen in de bus:</b> {{ $allParticipantsInBuss }}
                            <br>
                            <b>Hoeveel mensen we missen:</b> {{$differenceParticipantsInBusses}}
                            <br>
                            <b>Aantal bussen:</b> {{$busses->count()}}
                            <br>
                            <input class="btn btn-primary" type="submit" value="Reset" onclick="return confirm('Weet je zeker dat je alle bussen wilt verwijderen? Dit kan niet ongedaan worden!')">
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

<div class="container containerBus">
    <div class="col-md-12">
        @if ($busses != null)
            <div class="row">
                @foreach ($busses as $bus)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                @if ($bus->busNumber == null)
                                <form action="/bus/addBusNumber" method="POST">
                                @csrf
                                    <input type="hidden" value="{{ $bus->id }}" name="id" id="id">
                                    <label class="labelBus mt-1" for="voornaam"><b>Busnummer:</b> </label>
                                    <input class="form-control{{ $errors->has('busNumber') ? ' is-invalid' : '' }}" value="{{ old('busNumber') }}" id="busNumber" name="busNumber" placeholder="Busnummer...">
                                    <input class="btn btn-primary mt-3" type="submit" value="Toevoegen">
                                </form>
                                @else
                                    <b>Busnummer:</b> {{ $bus->busNumber }}<br>
                                    <form action="bus/addPersons" method="POST">
                                    @csrf
                                        <input type="hidden" value="{{ $bus->id }}" name="id" id="id">
                                        <label class="labelBus mt-1" for="voornaam"><b>Aantal personen:</b>
                                            @if ($bus->personAmount > 0)
                                                {{ $bus->personAmount }} <br>
                                            @endif
                                        </label>
                                        <input class="form-control{{ $errors->has('personAmount') ? ' is-invalid' : '' }}" value="{{ old('personAmount') }}" id="personAmount" name="personAmount" placeholder="Aantal personen...">
                                        <input class="btn btn-primary mt-3" type="submit" value="Toevoegen">
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
