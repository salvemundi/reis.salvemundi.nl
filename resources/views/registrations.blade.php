@extends('layouts.app')
@section('content')
<script>
setActive("registrations");
</script>
<div class="row">
    <div class="col-12 col-lg-6 container">
        <div class="table-responsive">
            <h1 class="display-5">Niet geverifieerde personen</h1>
            <table id="table" data-toggle="table" data-search="true" data-sortable="true" data-pagination="true"
            data-show-columns="true">
                <thead>
                    <tr class="tr-class-1">
                        <th data-field="firstName" data-sortable="true">Voornaam</th>
                        <th data-field="insertion" data-sortable="true">Tussenvoegsel</th>
                        <th data-field="lastName" data-sortable="true">Achternaam</th>
                        <th data-field="email" data-sortable="true">Email</th>
                        <th data-field="createdat" data-sortable="true">Inschrijf Datum</th>
                        <th data-field="daysDif" data-sortable="true">Dagen geleden ingeschreven</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participantsWhoDidntVerify as $participantWhoDidntVerify)
                        <tr id="tr-id-3" class="tr-class-2" data-title="bootstrap table">
                            <td data-value="{{ $participantWhoDidntVerify->firstName }}">{{ $participantWhoDidntVerify->firstName }}</td>
                            <td data-value="{{ $participantWhoDidntVerify->insertion }}">{{ $participantWhoDidntVerify->insertion }}</td>
                            <td data-value="{{ $participantWhoDidntVerify->lastName }}">{{ $participantWhoDidntVerify->lastName }}</td>
                            <td data-value="{{ $participantWhoDidntVerify->email }}">{{ $participantWhoDidntVerify->email }}</td>
                            <td data-value="{{ $participantWhoDidntVerify->created_at }}">{{ date('d-m-Y', strtotime($participantWhoDidntVerify->created_at)) }}</td>
                            <td data-value="{{ $participantWhoDidntVerify->dateDifference }}">{{ $participantWhoDidntVerify->dateDifference}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-12 col-lg-6 container">
        <div class="table-responsive">
            <h1 class="display-5">Geverifieerde personen</h1>
            <table id="table" data-toggle="table" data-search="true" data-sortable="true" data-pagination="true"
            data-show-columns="true">
                <thead>
                    <tr class="tr-class-1">
                        <th data-field="firstName" data-sortable="true">Voornaam</th>
                        <th data-field="insertion" data-sortable="true">Tussenvoegsel</th>
                        <th data-field="lastName" data-sortable="true">Achternaam</th>
                        <th data-field="email" data-sortable="true">Email</th>
                        <th data-field="daysDif" data-sortable="true">Geverifieerd op</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participantsWhoDidVerify as $participantWhoDidVerify)
                        <tr id="tr-id-3" class="tr-class-2" data-title="bootstrap table">
                            <td data-value="{{ $participantWhoDidVerify->firstName }}">{{ $participantWhoDidVerify->firstName }}</td>
                            <td data-value="{{ $participantWhoDidVerify->insertion }}">{{ $participantWhoDidVerify->insertion }}</td>
                            <td data-value="{{ $participantWhoDidVerify->lastName }}">{{ $participantWhoDidVerify->lastName }}</td>
                            <td data-value="{{ $participantWhoDidVerify->email }}">{{ $participantWhoDidVerify->email }}</td>
                            <td data-value="{{ $participantWhoDidVerify->updated_at }}">{{date('d-m-Y', strtotime($participantWhoDidVerify->updated_at))}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
