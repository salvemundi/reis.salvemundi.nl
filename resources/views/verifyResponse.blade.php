@extends('layouts.guapp')
@section('content')
@if($Response)
    <h1>Je ben geverifieerd! Je kunt deze pagina sluiten</h1>
    <meta http-equiv="refresh" content="2;URL=https://www.salvemundi.nl/">
@else
    <h1>Deze code is niet valide! Neem contact met ons op!</h1>
    <meta http-equiv="refresh" content="10;URL=https://intro.salvemundi.nl/">
@endif
@endsection
