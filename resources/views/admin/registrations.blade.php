@extends('layouts.app')
@section('content')
<script>
setActive("registrations");
</script>
<div class="row">
    <div class="col-12 col-lg-6 container">
        <div class="table-responsive">
            <h1 class="display-5">Aanmeldingen</h1>
            <table id="table" data-toggle="table" data-search="true" data-sortable="true" data-pagination="true"
            data-show-columns="true">
                <thead>
                    <tr class="tr-class-1">
                        <th data-field="firstName" data-sortable="true">Naam</th>
                        <th data-field="email" data-sortable="true">Email</th>
                        <th data-field="verified" data-sortable="true">Geverifieerd</th>
                        <th data-field="createdat" data-sortable="true">Inschrijf Datum</th>
                        <th data-field="daysDif" data-sortable="true">Dagen geleden ingeschreven</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $participant)
                        <tr id="tr-id-3" class="tr-class-2" data-title="bootstrap table">
                            @if($participant->insertion == null)
                                <td>{{ $participant->firstName . " " . $participant->lastName }}</td>
                            @else
                                <td>{{ $participant->firstName . " " .$participant->insertion . " " . $participant->lastName }}</td>
                            @endif
                            <td data-value="{{ $participant->email }}">{{ $participant->email }}</td>
                            <td data-value="{{ $participant->verified }}">{{ $participant->verified ? 'ja' : 'nee' }}</td>
                            <td data-value="{{ $participant->created_at }}">{{ date('d-m-Y', strtotime($participant->created_at)) }}</td>
                            <td data-value="{{ $participant->dateDifference }}">{{ $participant->dateDifference}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
