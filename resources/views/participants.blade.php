@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 col-md-6 container">
        <div class="table-responsive">
            <table id="table" data-toggle="table" data-search="true" data-sortable="true" data-pagination="true"
            data-show-columns="true">
                <thead>
                    <tr class="tr-class-1">
                        <th data-field="firstName" data-sortable="true">Naam</th>
                        <th data-field="data" data-sortable="true">Gegevens</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $participant)
                        <tr id="tr-id-3" class="tr-class-2" data-title="bootstrap table">
                            <td data-value="{{ $participant->firstName }}">{{$participant->firstName}} {{ $participant->lastName }}</td>
                            <td data-value="{{ $participant->id }}"><a href="/participants/{{$participant->id}}"><button type="button" class="btn btn-primary">Details</button></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-12 col-md-6 container mb-5">
        @if($selectedParticipant)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $selectedParticipant->firstName}} {{ $selectedParticipant->lastName }}</h5>
                <span>
                    <b>Verjaardag:</b> {{ $selectedParticipant->birthday}}<br>
                    <b>Email:</b> {{ $selectedParticipant->email}}<br>
                    <b>Telefoon nummer:</b> {{ $selectedParticipant->phoneNumber}}<br>
                    <b>Leerjaar:</b> {{ $selectedParticipant->studentYear}}<br>
                    <b>Naam Ouder:</b> {{ $selectedParticipant->firstNameParent}} {{ $selectedParticipant->lastNameParent}}<br>
                    <b>Adres Ouder:</b> {{ $selectedParticipant->addressParent}}<br>
                    <b>Telefoonnummer ouder:</b> {{ $selectedParticipant->phoneNumberParent}}<br>
                    <b>Allergieën:</b> {{ $selectedParticipant->medicalIssues}}<br>
                    <b>Bijzonderheden:</b> {{ $selectedParticipant->specials}}<br>
                    @if ($selectedParticipant->covidTest !== 0)
                        <b>Covid-test:</b> {{ App\Enums\CovidProof::fromValue($selectedParticipant->covidTest)->key}}<br>
                    @endif
                    @if (!$selectedParticipant->checkedIn)
                    <form method="post" action="/participants/{{ $selectedParticipant->id }}/checkIn">
                        @csrf<input type="hidden" name="userId" value="{{ $selectedParticipant->id }}">
                        <select class="form-control" name="proof">
                            <!-- foreach -->
                            @foreach (\App\Enums\CovidProof::getKeys() as $item)
                                <option value="{{\App\Enums\CovidProof::fromKey($item)->value}}">{{$item}}</option>
                            @endforeach
                        </select>
                        <br>
                        <button type="submit" class="btn btn-success">Checkin</button>
                    </form>
                    @else
                    <form method="post" action="/participants/{{ $selectedParticipant->id }}/checkOut">
                        @csrf
                        <button type="submit" class="btn btn-danger">Checkout</button>
                    </form>
                    @endif
                </span>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
