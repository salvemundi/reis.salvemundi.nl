@extends('layouts.app')
@section('content')
<script>
setActive("participants");
</script>
<div class="row">
    @if(!Request::is('participants'))
        <div class="col-12 col-md-6 container">
    @else
        <div class="col-12 container">
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    @if(session()->has('message'))
        <div class="alert alert-primary">
            {{ session()->get('message') }}
        </div>
    @endif
        <div class="d-flex">
            <button type="button" class="btn btn-danger ms-1" data-bs-toggle="modal" data-bs-target="#checkoutEveryoneModal">
                Check allen uit
            </button>

            <div class="dropdown" style="margin-left: 4px;">
                <button class="btn btn-secondary dropdown-toggle" style="width: auto !important;" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                    Mailing
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <li>
                        <form method="POST" action="/registrations">
                            @csrf
                            <button type="submit" class="dropdown-item">Stuur betaling email</button>
                        </form>
                    </li>
                    <li>
                        <form method="POST" action="/participants/resendVerificationEmails">
                            @csrf
                            <button type="submit" class="dropdown-item">Stuur email niet geverifieerd</button>
                        </form>
                    </li>
                    <li>

                        <form method="POST" action="/participants/resendQRcode">
                            @csrf
                            <button type="submit" class="dropdown-item">Stuur QR-codes</button>
                        </form>

                    </li>
                </ul>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="checkoutEveryoneModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Iedereen uitchecken?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Weet je zeker dat je iedereen wil uitchecken?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nah doe toch maar nie</button>
                            <form method="POST" action="/participants/checkOutEveryone">
                                @csrf
                                <button type="submit" class="btn btn-danger">Bevestigen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table id="table" data-toggle="table" data-search="true" data-sortable="true" data-pagination="true"
            data-show-columns="true">
                <thead>
                    <tr class="tr-class-1">
                        <th data-field="firstName" data-sortable="true">Naam</th>
                        <th data-field="role" data-sortable="true">Rol</th>
                        <th data-field="verified" data-sortable="true">Geverifieerd</th>
                        <th data-field="checkedIn" data-sortable="true">Checked in</th>
                        <th data-field="data" data-sortable="true">Gegevens</th>
                        @if(Request::is('participants'))
                            <th data-field="createdat" data-sortable="true">Dag van inschrijving</th>
                            <th data-field="updatedat" data-sortable="true">Laatste aanpassing</th>
                            <th data-field="daysDif" data-sortable="true">Dagen geleden ingeschreven</th>
                        @endif
                        <th data-field="email" data-sortable="false">email</th>
                        <th data-field="paid" data-sortable="true">Betaald</th>
                        <th data-field="isOnReserveList" data-sortable="true">Wachtrij</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $participant)
                        <tr id="tr-id-3" class="tr-class-2" data-title="bootstrap table">
                            <td data-value="{{ $participant->firstName }}">{{ $participant->firstName }} {{ $participant->insertion ?? null}} {{ $participant->lastName }}</td>
                            <td data-value="{{ $participant->role }}">{{ \App\Enums\Roles::fromValue($participant->role)->description }}</td>
                            <td data-value="{{ $participant->isVerified() }}">{{ $participant->isVerified() ? 'Ja' : 'Nee' }}</td>

                            @if($participant->checkedIn == 1)
                                <td data-value="{{ $participant->checkedIn }}">True</td>
                            @else
                                <td data-value="{{ $participant->checkedIn }}">False</td>
                            @endif
                            <td data-value="{{ $participant->id }}"><a href="/participants/{{$participant->id}}"><button type="button" class="btn btn-primary">Details</button></a></td>
                            @if(Request::is('participants'))
                                <td data-value="{{ $participant->created_at }}">{{ $participant->created_at }}</td>
                                <td data-value="{{ $participant->updated_at }}">{{ $participant->updated_at }}</td>
                                <td data-value="{{ $participant->dateDifference }}">{{ $participant->dateDifference }}</td>
                            @endif
                            <td data-value="{{ $participant->email }}">{{$participant->email}}</td>
                            <td>
                                @if($participant->hasCompletedFinalPayment())
                                    <span class="badge rounded-pill bg-success text-black">Restbetaling voltooid</span>
                                @else
                                    @if($participant->hasCompletedDownPayment())
                                        <span class="badge rounded-pill bg-success text-black">Aanbetaling voltooid</span>
                                    @else
                                        @if($participant->latestPayment)
                                            @switch($participant->latestPayment->paymentStatus)
                                                @case(1)
                                                    <span class="badge rounded-pill bg-warning text-black">{{ \App\Enums\PaymentStatus::getDescription(1) }}</span>
                                                    @break
                                                @case(6)
                                                    <span class="badge rounded-pill bg-danger text-black">{{ \App\Enums\PaymentStatus::getDescription(6) }}</span>
                                                    @break
                                                @default
                                                    <span class="badge rounded-pill bg-secondary">{{ \App\Enums\PaymentStatus::getDescription($participant->latestPayment->paymentStatus) }}</span>
                                                    @break
                                            @endswitch
                                        @else
                                            <span class="badge rounded-pill bg-secondary">Geen transacties</span>
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>
                                <form action="/participants/reserveList/{{ $participant->id }}" method="POST">
                                    @csrf
                                    @if($participant->isOnReserveList)
                                        <button type="submit" class="btn btn-primary buttonPart me-2">Zet uit de wachtrij</button>
                                    @else
                                        <button type="submit" class="btn btn-danger buttonPart me-2">Zet in de wachtrij</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if(!Request::is('participants'))
    <div class="col-12 col-md-6 container mb-5">
        @isset($selectedParticipant)
                @include('include.participantEditModal', ['participant' => $selectedParticipant])
                @include('include.participantConfirmationMailModal', ['participant' => $selectedParticipant])
                @include('include.addActivityToParticipantModal', ['participant' => $selectedParticipant,'$activities' => $activities])

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $selectedParticipant->firstName }} {{ $selectedParticipant->insertion ?? null}} {{ $selectedParticipant->lastName }}</h5>
                        <p class="card-text">Gegevens:</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Leeftijd: {{ \Carbon\Carbon::parse($selectedParticipant->birthday)->diff(\Carbon\Carbon::now())->format('%y years') }}</li>
                        <li class="list-group-item">E-mail: {{$selectedParticipant->email}}</li>
                        <li class="list-group-item">Telefoon nummer: {{ $selectedParticipant->phoneNumber }}</li>
                        <li class="list-group-item">Allergieën: {{ $selectedParticipant->medicalIssues ?? "N.v.t" }}</li>
                        <li class="list-group-item">Bijzonderheden: {{ $selectedParticipant->specials ?? "N.v.t" }}</li>
                    </ul>
                    <div class="card-body d-flex flex-md-row flex-column">
                        <p class="card-text center">Geselecteerde activiteiten:</p>
                        <button style="scale: 1.3" class="card-link-button"  data-bs-toggle="modal" data-bs-target="#addActivityTo{{$selectedParticipant->id}}">
                            <a data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Koppel activiteit"><i class="icon-activity-delete fas fa-plus-circle"></i></a>
                        </button>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($selectedParticipant->activities as $activity)
                            @include('include.deleteActivityFromParticipantModal', ['participant' => $selectedParticipant,'activity' => $activity])
                                <li class="list-group-item">
                                        <div style="float:left;">{{ $activity->name }}</div>
                                        @if(!$selectedParticipant->hasCompletedAllPayments() || true)
                                            <button style="float:right;scale: 1.3;" class="card-link-button"  data-bs-toggle="modal" data-bs-target="#deleteActivity{{$activity->id}}From{{$selectedParticipant->id}}">
                                                <a data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Ontkoppel activiteit"><i class="icon-activity-delete fas fa-minus-circle float-right"></i></a>
                                            </button>
                                        @endif
                                </li>
                        @endforeach
                    </ul>
                    <div class="card-body">
                        <div class="d-flex flex-sm-row flex-column ">
                            @if (!$selectedParticipant->checkedIn)
                                <form method="post" class="center" action="/participants/{{ $selectedParticipant->id }}/checkIn">
                                    @csrf
                                    <button type="submit" href="#" style="visibility: visible !important;" class="card-link card-link-button">Check in</button>
                                </form>
                            @else
                                <form method="post" class="center" action="/participants/{{ $selectedParticipant->id }}/checkOut">
                                    @csrf
                                    <button type="submit" href="#" style="visibility: visible !important;" class="card-link card-link-button">Check uit</button>
                                </form>
                            @endif

                            <button href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="card-link card-link-button">Verwijder</button>
                            <button class="card-link card-link-button" data-bs-toggle="modal" data-bs-target="#confirmationMailModal{{$selectedParticipant->id}}">
                                Confirmatie mail
                            </button>
                            <button type="button" class="card-link card-link-button" data-bs-toggle="modal" data-bs-target="#edit{{ $selectedParticipant->id }}">
                                Bewerk
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Verwijder</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Weet je zeker dat jij deelnemer {{ $selectedParticipant->firstName. " " .$selectedParticipant->lastName }} wilt verwijderen?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form method="post" action="/participants/{{ $selectedParticipant->id }}/delete">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Verwijder</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        @endisset
    </div>
</div>
    @endif
@endsection
