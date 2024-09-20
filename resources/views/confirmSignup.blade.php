@extends('layouts.guapp')
@section('content')
<div class="container">
    @if(session()->has('message'))
    <div class="alert alert-primary">
        {{ session()->get('message') }}
    </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif

    <form action="/inschrijven/betalen/{{ $confirmationToken->id }}" method="post" enctype="multipart/form-data">
        @csrf
        <br>
        <h2 class="h2">Confirm the following information</h2>
        <input type="hidden" name="uid" id="uid" value="{{ $confirmationToken->participant->id }}">
        <input type="hidden" name="confirmation" id="confirmation" value="1">
        <div class="form-group">
            <label for="voornaam">Full name(s)* <i class="fas fa-info-circle purple" style="white-space: pre-line;" data-toggle="tooltip" data-placement="top" title="The same that has been written on your passport or id"></i></label>
            <input class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" name="firstName" value="{{ $confirmationToken->participant->firstName }}">
        </div><br>
        @if($confirmationToken->participant->insertion != "" || $confirmationToken->participant->insertion != null)
        <div class="form-group">
            <label for="voornaam">Insertion</label>
            <input class="form-control{{ $errors->has('insertion') ? ' is-invalid' : '' }}" name="insertion" value="{{ $confirmationToken->participant->insertion }}">
        </div><br>
        @endif

        <div class="form-group">
            <label for="voornaam">Lastname*</label>
            <input class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" name="lastName" value="{{ $confirmationToken->participant->lastName }}">
        </div><br>

        <div class="form-group">
            <label for="voornaam">Birthday*</label>
            <input class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" value="{{ $confirmationToken->participant->birthday }}" type="date" id="birthday" name="birthday" placeholder="MM-DD-JJJJ...">
        </div><br>

        <div class="form-group">
            <label for="voornaam">Email*</label>
            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $confirmationToken->participant->email }}" id="email" name="email" placeholder="Email...">
        </div><br>

        <div class="form-group">
            <label for="voornaam">Phonenumber*</label>
            <input class="form-control{{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}" value="{{ $confirmationToken->participant->phoneNumber }}" id="phoneNumber" name="phoneNumber" placeholder="Phonenumber...">
        </div><br>
        @if(app\Models\Setting::where('name', 'CollectIdentificationDocuments')->first()->value == 'true')
        <div class="form-group">
            <label for="voornaam">Document Type*</label>
            <select class="form-control" name="documentType">
                @foreach(\App\Enums\DocumentTypes::asArray() as $key => $val)
                    @if($val === $confirmationToken->participant->documentType ?? 0)
                        <option selected value="{{$val}}">{{\App\Enums\DocumentTypes::getDescription($val)}}</option>
                    @else
                        <option value="{{$val}}">{{\App\Enums\DocumentTypes::getDescription($val)}}</option>
                    @endif                @endforeach
            </select>
        </div><br>

        <div class="form-group">
            <label for="voornaam">Document nummer*</label>
            <input class="form-control{{ $errors->has('documentNumber') ? ' is-invalid' : '' }}" value="{{ $confirmationToken->participant->documentNumber }}" id="documentNumber" name="documentNumber" placeholder="Document number...">
        </div><br>
        @endif
        @if($driverSignup && !$confirmationToken->participant->hasCompletedDownPayment())
            <div class="form-group mb-4 form-check">
                <input class="form-check-input form-check me-2" type="checkbox" name="driverVolunteer" id="driverVolunteer">
                <label class="form-check-label mt-2" for="driverSignup">Ik wil vrijwillig aanmelden om busje te rijden tijdens de reis</label>
            </div>
        @endif
        @if($activities->count() > 0)
        @if(!$confirmationToken->participant->hasCompletedDownPayment() ||  $activitySignupAfterDownPayment)
        <div class="form-group">
            <label for="activities">Choose the options you would like</label>
            @foreach($activities as $activity)
            <div class="form-check mt-2">
                <input @if(!empty($confirmationToken->participant->activities->find($activity->id)) || true) checked @endif class="activity-checkbox form-check-input" name="activities[]" data-price="{{ $activity->price}}" value="{{ $activity->id }}" type="checkbox" id="flexCheckDefault{{ $activity->id }}">
                <label class="form-check-label" for="flexCheckDefault{{ $activity->id }}">
                    {{ ucfirst($activity->name) }}: Price: €{{ $activity->price }} <i class="fas fa-info-circle purple" style="white-space: pre-line;" data-toggle="tooltip" data-placement="top" title="{{ $activity->description }}"></i>
                </label>
            </div>
            @endforeach
        </div>
        @else
        <div class="form-group">
            <label for="activities">Base trip price (excluding down payment): €{{ $basePrice }}</label>
        </div>
        @if($confirmationToken->participant->activities->count() > 0)
        <div class="form-group">
            <label for="activities">Options you have chosen before:</label>
            <ul>
                @foreach($confirmationToken->participant->activities as $activity)
                <li>{{ ucfirst($activity->name) }} (€{{ $activity->price }})</li>
                @endforeach
            </ul>
        </div>
        @endif
        @endif
        @endif
        <div class="form-group">
            <label for="voornaam">Allergies</label>
            <textarea class="form-control{{ $errors->has('medicalIssues') ? ' is-invalid' : '' }}" type="textarea" id="medicalIssues" name="medicalIssues" placeholder="Allergies...">{{{ $confirmationToken->participant->medicalIssues }}}</textarea>
        </div><br>

        <div class="form-group">
            <label for="voornaam">Particularities</label>
            <textarea class="form-control{{ $errors->has('specials') ? ' is-invalid' : '' }}" type="textarea" id="specials" name="specials" placeholder="Particularities...">{{{ $confirmationToken->participant->specials }}}</textarea>
        </div><br>

        <div class="form-group mb-5">
            <br>
            @if($confirmationToken->participant->hasCompletedAllPayments())
            <input class="btn btn-primary" type="submit" value="Save">
            @else
            <input class="btn btn-primary" id="buttonPrice" type="submit" value="Pay  € {{ $price }}">
            @endif
        </div>
    </form>
</div>
@if($confirmationToken->participant->hasCompletedDownPayment())
<script>
    function updatePrice() {
        let basePrice = parseFloat("{{ $basePrice }}"); // Convert base price to float
        let totalPrice = basePrice; // Initialize total price with base price

        // Loop through each checkbox to check if it's checked and update the total price
        document.querySelectorAll('.activity-checkbox').forEach(function(checkbox) {
            if (checkbox.checked) {
                var activityPrice = parseFloat(checkbox.getAttribute('data-price')); // Get activity price
                totalPrice += activityPrice; // Add activity price to total price
            }
        });

        // Update the displayed price
        document.getElementById('buttonPrice').value = "Pay  € " + totalPrice.toFixed(2); // Update the button value
    }

    // Add event listeners to checkboxes to update price on change
    document.querySelectorAll('.activity-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', updatePrice);
    });
</script>
@endif
@endsection
