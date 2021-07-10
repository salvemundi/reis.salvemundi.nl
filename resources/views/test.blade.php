@extends('layouts.app')
@section('content')

<script>
    setActive("test");
</script>
<div class="center">
    <div class="row container">
    <h2 class="h2 center">Deze deelnemers moeten getest worden</h2>
        <div class="table-responsive">
            <table id="table" data-toggle="table" data-search="true" data-sortable="true" data-pagination="true"
            data-show-columns="true">
                <thead>
                    <tr class="tr-class-1">
                        <th data-field="firstName" data-sortable="true">Naam</th>
                        <th data-field="medicalIssues" data-sortable="true">Allergieën</th>
                        <th data-field="specials" data-sortable="true">Bijzonerheden</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testedParticipants as $participant)
                        <tr id="tr-id-3" class="tr-class-2" data-title="bootstrap table">
                            <td data-value="{{ $participant->firstName }}">{{$participant->firstName}} {{ $participant->lastName }}</td>
                            <td data-value="{{ $participant->medicalIssues }}">{{$participant->medicalIssues}}</td>
                            <td data-value="{{ $participant->specials }}">{{$participant->specials}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
