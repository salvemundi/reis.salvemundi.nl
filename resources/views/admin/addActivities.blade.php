@extends('layouts.app')
@section('content')
    <script>
        setActive("activities");
    </script>
    <style>
        .nav-tabs{
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .nav-link {
            color: black !important;
        }

    </style>
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
                    <label for="description">Omschrijving</label>
                    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" type="textarea" id="description" name="description" placeholder="Omschrijving...">{{{ $activity->description ?? old('description') }}}</textarea>
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
            <h5>Inschrijvingen</h5>
            <nav>
                <div class="nav nav-tabs d-flex flex-row justify-content-start" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Wel ingeschreven</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Niet ingeschreven</button>
                </div>
            </nav>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    @foreach($activity->participants as $participant)
                        <div class="card">
                            <div class="card-body text-black">
                                {{$participant->getFullName()}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    @foreach($unlinkedParticipants as $participant)
                        <div class="card">
                            <div class="card-body text-black">
                                {{$participant->getFullName()}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
