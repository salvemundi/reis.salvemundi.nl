@extends('layouts.app')
@section('content')
<script>
setActive("dashboard");
</script>
<div class="container">
    <p class="user">Welkom {{ session('userName') }}</p>
</div>
@endsection
