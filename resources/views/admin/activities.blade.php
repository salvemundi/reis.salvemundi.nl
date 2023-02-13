@extends('layouts.app')
@section('content')
    <script>
        setActive("activities");
    </script>

    <div class="row">
        <div class="col-12 col-lg-6 container">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="table-responsive">
                <h1 class="display-5 center">Opties</h1>
                <table id="table" data-toggle="table" data-search="true" data-sortable="true" data-pagination="true"
                       data-show-columns="true">
                    <thead>
                    <tr class="tr-class-1">
                        <th data-field="name" data-sortable="true">Naam</th>
                        <th data-field="description" data-sortable="true">Omschrijving</th>
                        <th data-field="price" data-sortable="true">Prijs</th>
                        <th data-field="options" data-sortable="true">Opties</th>
                        <th data-field="verkocht" data-sortable="true">Aantal verkocht</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($activities as $activity)
                        <tr id="tr-id-3" class="tr-class-2" data-title="bootstrap table">
                            <td data-value="{{ $activity->name }}">{{ $activity->name }}</td>
                            <td data-value="{{ $activity->description }}">{{ $activity->description }}</td>
                            <td data-value="{{ $activity->price }}">{{ $activity->price }}</td>
                            <td data-value="{{ $activity->id }}">
                                <a class="btn btn-primary mb-1 w-100" href="/activities/update/{{ $activity->id }}">
                                    Bewerken
                                </a>

                                <button class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $activity->id }}">
                                    Verwijderen
                                </button>
                            </td>
                            <td data-value="{{ $activity->participants()->distinct('participants.id')->count() }}">{{ $activity->participants()->distinct('participants.id')->count() }}</td>
                        </tr>
                        <div class="modal fade" id="deleteModal{{ $activity->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Verwijder blog</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Weet je zeker dat je {{ $activity->name }} wil verwijderen?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nee</button>
                                        <form action="/activities/delete/{{ $activity->id }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Ja</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <a class="mt-3 btn btn-primary" href="activities/create" style="width: 100%; color: white !important;">Toevoegen</a>
        </div>
    </div>
@endsection
