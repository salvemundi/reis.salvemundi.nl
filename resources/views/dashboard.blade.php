@extends('layouts.app')
@section('content')
<div class="container">
    <p class="user">Welkom {{ session('userName') }}</p>
</div>
@endsection
