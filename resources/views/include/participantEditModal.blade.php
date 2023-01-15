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
            <form method="POST" action="/participants/{{$participant->id}}/storeEdit">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="participantEmail" class="form-label">Email adres</label>
                        <input type="email" class="form-control" value="{{ $participant->email }}" id="participantEmail" name="participantEmail" placeholder="name@example.com">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Naam</span>
                        <input type="text" aria-label="First name" id="participantFirstName" name="participantFirstName" value="{{ $participant->firstName }}" placeholder="Voornaam" class="form-control">
                        <input type="text" aria-label="Last name" id="participantInsertion" name="participantInsertion" value="{{ $participant->insertion }}" placeholder="Tussenvoegsel" class="form-control">
                        <input type="text" aria-label="Last name" id="participantLastName" name="participantLastName" value="{{ $participant->lastName }}" placeholder="Achternaam" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="participantBirthday" class="form-label">Geboortedatum</label>
                        <input type="date" value="{{ $participant->birthday }}" name="participantBirthday" class="form-control" id="participantBirthday">
                    </div>
                    <div class="mb-3">
                        <label for="participantPhoneNumber" class="form-label">Telefoon nummer</label>
                        <input type="text" class="form-control" value="{{ $participant->phoneNumber }}" name="participantPhoneNumber" id="participantPhoneNumber" placeholder="+31 6 1234567">
                    </div>
                    <div class="mb-3">
                        <label for="participantMedicalIssues" class="form-label">Medische toestanden / allergieën:</label>
                        <textarea class="form-control" name="participantMedicalIssues" id="participantMedicalIssues" rows="3">{{ $participant->medicalIssues }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="participantSpecial" class="form-label">Andere bijzonderheden: </label>
                        <textarea class="form-control" name="participantSpecial" id="participantSpecial" rows="3">{{ $participant->specials }}</textarea>
                    </div>
                    <br>

                    <label for="participantRole" class="form-label">Rol: </label>
                    <select id="participantRole" name="participantRole" class="form-select mb-3" aria-label="Default select example">
                            @foreach(App\Enums\Roles::asArray() as $key => $val)
                                @if($val === $participant->role)
                                    <option selected value="{!!$val !!}">{{ App\Enums\Roles::coerce($key)->description }}</option>
                                @else
                                    <option value="{!! $val !!}">{{ App\Enums\Roles::coerce($key)->description }}</option>
                                @endif
                            @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluit</button>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </div>
            </form>
        </div>
    </div>
</div>
