@extends('layouts.app')
@section('content')
<div class="container">
    <p class="user">Welkom {{ session('id') }}</p>
</div>
@endsection
