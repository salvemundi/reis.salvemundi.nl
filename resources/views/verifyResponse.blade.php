@extends('layouts.guapp')
@section('content')
@if($Response)
    <h1>Je ben geverifieerd! Je kunt deze pagina sluiten</h1>
@else
    <h1>Deze code is niet valide! Neem contact met ons op!</h1>
@endif
