@extends('layouts.app')
@section('content')
<script>
setActive("registrations");
</script>
<div class="row">
    <div class="col-12 col-lg-11 container">
        @if(session()->has('status'))
            <div class="alert alert-primary">
                {{ session()->get('status') }}
            </div>
        @endif
        <div class="table-responsive">
            <h1 class="display-5">Aanmeldingen</h1>
            <table id="table" data-toggle="table" data-search="true" data-sortable="true" data-pagination="true"
            data-show-columns="true">
                <thead>
                    <tr class="tr-class-1">
                        <th data-field="firstName" data-sortable="true">Naam</th>
                        <th data-field="email" data-sortable="true">Email</th>
                        <th data-field="verified" data-sortable="true">Geverifieerd</th>
                        <th data-field="createdat" data-sortable="true">Inschrijf Datum</th>
                        <th data-field="daysDif" data-sortable="true">Dagen geleden ingeschreven</th>
                        <th data-field="paid" data-sortable="true">Betaald</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $participant)
                        <tr id="tr-id-3" class="tr-class-2" data-title="bootstrap table">
                            @if($participant->insertion == null)
                                <td>{{ $participant->firstName . " " . $participant->lastName }}</td>
                            @else
                                <td>{{ $participant->firstName . " " .$participant->insertion . " " . $participant->lastName }}</td>
                            @endif
                            <td data-value="{{ $participant->email }}">{{ $participant->email }}</td>
                            <td data-value="{{ $participant->verified }}">{{ $participant->verified ? 'Ja' : 'Nee' }}</td>
                            <td data-value="{{ $participant->created_at }}">{{ date('d-m-Y', strtotime($participant->created_at)) }}</td>
                            <td data-value="{{ $participant->dateDifference }}">{{ $participant->dateDifference }}</td>
                            <td data-value="{{ $participant->paid }}">
                                @if($participant->latestPayment)
                                    @if($participant->latestPayment->paymentStatus == \App\Enums\PaymentStatus::paid)
                                        <span class="badge rounded-pill bg-success text-black">Betaald</span>
                                    @elseif($participant->latestPayment->paymentStatus == \App\Enums\PaymentStatus::pending)
                                        <span class="badge rounded-pill bg-warning text-black">In behandeling</span>
                                    @elseif($participant->latestPayment->paymentStatus == \App\Enums\PaymentStatus::canceled)
                                        <span class="badge rounded-pill bg-secondary">Geannuleerd</span>
                                    @elseif($participant->latestPayment->paymentStatus == \App\Enums\PaymentStatus::expired)
                                        <span class="badge rounded-pill bg-secondary">Verlopen</span>
                                    @elseif($participant->latestPayment->paymentStatus == \App\Enums\PaymentStatus::failed)
                                        <span class="badge rounded-pill bg-danger">Gefaald</span>
                                    @elseif($participant->latestPayment->paymentStatus == \App\Enums\PaymentStatus::open)
                                        <span class="badge rounded-pill bg-secondary">Open</span>
                                    @endif
                                @else
                                    <span class="badge rounded-pill bg-secondary">Geen transacties</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <form method="POST" action="">
            @csrf
            <button type="submit" class="btn btn-primary">Stuur betaling email</button>
        </form>
        <br>
        <form method="POST" action="/participants/resendVerificationEmails">
            @csrf
            <button type="submit" class="btn btn-primary">Stuur email naar niet geverifieerde deelnemers</button>
        </form>
    </div>
</div>
@endsection
