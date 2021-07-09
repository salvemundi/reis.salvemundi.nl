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
                        <h6 class="text-uppercase text-muted mb-2">Mensen ingecheckt (totaal):</h6>
                        <span class="h2 mb-0">{{ $amountTotalCheckedIn }} ({{ $amountTotal }})</span>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-samu progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{100.0 / $amountTotal * $amountTotalCheckedIn}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
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
                        <span class="h2 mb-0">{{ $amountCrewCheckedIn }} ({{ $amountCrew }})</span>
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
                        <span class="h2 mb-0">{{ $amountChildrenCheckedIn }} ({{ $amountChildren }})</span>
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
                        <span class="h2 mb-0">{{ $amountParentsCheckedIn }} ({{ $amountParents }})</span>
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
                        <span class="h2 mb-0">{{ $amountTeachersCheckedIn }} ({{ $amountTeachers }})</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
