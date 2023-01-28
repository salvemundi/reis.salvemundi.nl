@extends('layouts.app')
@section('content')
    <script>
        setActive("activities");
    </script>
    <div class="container center">
        <div id="contact" class="col-md-6">
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
            @if(!isset($activity))
                <form action="/activities/create/save" method="post" enctype="multipart/form-data">
            @else
                <form action="/activities/update/{{$activity->id}}" method="post" enctype="multipart/form-data">
            @endif
                @csrf
                <br>
                <h2 class="h2">Optie toevoegen / bewerken</h2>

                <div class="form-group">
                    <label for="name">Optie naam*</label>
                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $activity->name ?? old('name') }}" id="name" name="name" placeholder="Activiteit naam...">
                </div><br>

                <div class="form-group">
                    <label for="price">Optie prijs*</label>
                    <input class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ $activity->price ?? old('price') }}" id="price" name="price" placeholder="Activiteit prijs...">
                </div><br>

                <div class="form-group mb-5">
                    <br>
                    <input class="btn btn-primary" type="submit" value="Opslaan">
                </div>
            </form>
        </div>
    </div>
@endsection
