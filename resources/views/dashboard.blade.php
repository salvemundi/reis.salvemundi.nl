@extends('layouts.app')
@section('content')
<script>
setActive("dashboard");
</script>

<div class="row">
    <h2 class="user center my-4">Welkom {{ session('userName') }}</h2>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                    <div class="row align-items-center gx-0">
                        <div class="col">
                        <h6 class="text-uppercase text-muted mb-2">Mensen aanwezig:</h6>
                        <span class="h2 mb-0">{{ $amountTotal }}</span>
                    </div>
                </div>
            </div>
        </div>
    <div>
</div>
<div class="row mb-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center gx-0">
                    <div class="col">
                        <h6 class="text-uppercase text-muted mb-2">Aantal crewleden:</h6>
                        <span class="h2 mb-0">{{ $amountCrew }}</span>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                        <div class="row align-items-center gx-0">
                        <div class="col">
                            <h6 class="text-uppercase text-muted mb-2">Aantal kinderen:</h6>
                            <span class="h2 mb-0">{{ $amountChildren }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="row mb-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center gx-0">
                    <div class="col">
                        <h6 class="text-uppercase text-muted mb-2">Aantal ouders:</h6>
                        <span class="h2 mb-0">{{ $amountParents }}</span>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                        <div class="row align-items-center gx-0">
                        <div class="col">
                            <h6 class="text-uppercase text-muted mb-2">Aantal docenten:</h6>
                            <span class="h2 mb-0">{{ $amountTeachers }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
