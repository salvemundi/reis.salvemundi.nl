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
            <h2 class="h2">Blog opslaan</h2>
            <input type="hidden" name="blogId" id="blogId" value="{{ $post->id ?? null }}">
            <div class="form-group">
                <label for="voornaam">Naam*</label>
                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $post->name ?? old('name') }}" id="name" name="name" placeholder="Naam...">
            </div><br>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control wrap{{ $errors->has('content') ? ' is-invalid' : '' }}" id="content" name="content" placeholder="Content...">{{ $post->content ?? old('content') }}</textarea>
            </div><br>

            <div class="form-group mb-5">
                <br>
                <input class="btn btn-primary" type="submit" value="Opslaan">
            </div>
        </form>
    </div>
</div>
@endsection
