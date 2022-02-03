@extends('layouts.guapp')
@section('content')
@foreach($posts as $post)
    <p>
        {{ $post->name }}
    </p>
@endforeach
@endsection
