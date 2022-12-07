@extends('layouts.app')
@section('content')
<script>
    setActive("blogs");
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
            <h1 class="display-5">Blogs / Emails</h1>
            <table id="table" data-toggle="table" data-search="true" data-sortable="true" data-pagination="true"
            data-show-columns="true">
                <thead>
                    <tr class="tr-class-1">
                        <th data-field="name" data-sortable="true">Naam</th>
                        <th data-field="options" data-sortable="true">Opties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr id="tr-id-3" class="tr-class-2" data-title="bootstrap table">
                            <td data-value="{{ $blog->name }}">{{ $blog->name }}</td>
                            <td data-value="{{ $blog->id }}">
                                <a class="btn btn-primary" href="/blogsadmin/save/{{ $blog->id }}">
                                    Bewerken
                                </a>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $blog->id }}">
                                    Verwijderen
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="deleteModal{{ $blog->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Verwijder blog</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  Weet je zeker dat je {{ $blog->name }} wil verwijderen?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nee</button>
                                  <a href="/blogsadmin/delete/{{ $blog->id }}" class="btn btn-danger">Ja</a>
                                </div>
                              </div>
                            </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a class="mt-3 btn btn-primary" href="blogsadmin/save" style="width: 100%;">Toevoegen</a>

        <form action="/occupied/save" method="post" enctype="multipart/form-data">
            <h2 class="h2">qr code percentage: {{$occupied->occupied ?? 0}}% </h2>
            <input type="hidden" name="blogId" id="blogId" value="{{ $blog->id ?? null }}">
            <div class="form-group">
                <label for="voornaam">Nieuwe percentage</label>
                <input type="number" class="form-control{{ $errors->has('occupied') ? ' is-invalid' : '' }}" id="occupied" name="occupied" placeholder="percentage...">
            </div> <br>
            <div class="form-group mb-5">
                <input class="btn btn-primary" type="submit" value="Change">
            </div>
            @csrf
        </form>
    </div>
</div>
@endsection
