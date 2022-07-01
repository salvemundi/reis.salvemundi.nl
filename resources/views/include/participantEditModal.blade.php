<div class="modal fade" id="edit{{ $participant->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 850px !important;">
        <div class="modal-content">
            <div class="modal-header">
                @if($participant->insertion)
                    <h5 class="modal-title" id="exampleModalLabel">{{ $participant->firstName." ".$participant->insertion." ".$participant->lastName}} </h5>
                @else
                    <h5 class="modal-title" id="exampleModalLabel">{{ $participant->firstName." ".$participant->lastName}} </h5>
                @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/participants/{{$participant->id}}/storeEdit">
                    <div class="mb-3">
                        <label for="participantEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" value="{{ $participant->email }}" id="participantEmail" placeholder="name@example.com">
                    </div>

                    <div class="mb-3">
                        <label for="participantFontysEmail" class="form-label">Fontys email address</label>
                        <input type="email" class="form-control" id="participantFontysEmail" placeholder="123456@student.fontys.nl">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">First and last name</span>
                        <input type="text" aria-label="First name" id="participantFirstName" value="{{ $participant->firstName }}" class="form-control">
                        <input type="text" aria-label="Last name" id="participantInsertion" value="{{ $participant->insertion }}" class="form-control">
                        <input type="text" aria-label="Last name" id="participantLastName" value="{{ $participant->lastName }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="participantBirthday" class="form-label">Birthday</label>
                        <input type="date" value="{{ $participant->birthday }}" class="form-control" id="participantBirthday">
                    </div>
                    <div class="mb-3">
                        <label for="participantPhoneNumber" class="form-label">Phonenumber</label>
                        <input type="text" class="form-control" id="participantPhoneNumber" placeholder="+31 6 1234567">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">First and last name Parent</span>
                        <input type="text" aria-label="First name" id="participantFirstNameParent" value="{{ $participant->firstNameParent }}" class="form-control">
                        <input type="text" aria-label="Last name" id="participantLastNameParent" value="{{ $participant->lastNameParent }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="participantAddress" class="form-label">Address parent</label>
                        <input type="text" class="form-control" id="participantAddress" placeholder="Street 1, Eindhoven">
                    </div>
                    <div class="mb-3">
                        <label for="participantParentPhoneNumber" class="form-label">Phonenumber parent</label>
                        <input type="text" class="form-control" id="participantParentPhoneNumber" placeholder="+31 6 1234567">
                    </div>
                    <div class="mb-3">
                        <label for="participantMedicalIssues" class="form-label">Any medical condition / allergies the participant may have:</label>
                        <textarea class="form-control" id="participantMedicalIssues" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="participantSpecial" class="form-label">Other specialties:</label>
                        <textarea class="form-control" id="participantSpecial" rows="3"></textarea>
                    </div>
                    <select id="participantRole" class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        @foreach(App\Enums\Roles::asArray() as $key => $val)
                            <option value="{{ $val }}">{{ App\Enums\Roles::coerce($key)->description }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
