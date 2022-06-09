@extends('layouts.app')
@section('content')
<script>
    setActive("blogs");
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
        <form action="/blogsadmin/save" method="post" enctype="multipart/form-data">
            @csrf
            <br>
            <h2 class="h2">Blog opslaan / Email versturen</h2>
            <input type="hidden" name="blogId" id="blogId" value="{{ $post->id ?? null }}">
            <div class="form-group">
                <label for="voornaam">Naam*</label>
                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $post->name ?? old('name') }}" id="name" name="name" placeholder="Naam...">
            </div><br>

            Bovenaan het mailtje komt standaard dit te staan: <br> <br>

            Beste {naam}, <br> <br>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control wrap{{ $errors->has('content') ? ' is-invalid' : '' }}" id="content" name="content" placeholder="Content...">{{ $post->content ?? old('content') }}</textarea>
            </div><br>

            Onderaan het mailtje komt standaard dit te staan: <br> <br>

            Met vriendelijke groet,<br>
            De introcommissie van Salve Mundi <br> <br>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="addBlog">
                <label class="form-check-label " for="addBlog">Blog toevoegen</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="sendEmail">
                <label class="form-check-label " for="sendEmail">Emails verzenden</label>
            </div> <br>

            <label for="content">Naar wie gaat deze mail, mensen die:</label>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="notVerified">
                <label class="form-check-label " for="notVerified">Email niet geverifierd</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="NotApplied">
                <label class="form-check-label " for="NotApplied">Nog niet betaald</label>
            </div>

            <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="Applied">
                <label class="form-check-label " for="Applied">Wel betaald</label>
            </div>


            <div class="form-group mb-5">
                <br>
                <input class="btn btn-primary" type="submit" value="Opslaan">
            </div>
        </form>
    </div>
</div>
@endsection
