<div class="modal fade" id="addActivityTo{{$participant->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 850px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Toevoegen activiteit voor {{ $participant->firstName }} {{$participant->insertion ?? null}} {{ $participant->lastName }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/participants/{{ $participant->id }}/activity/add">
                @csrf
            <div class="modal-body">
                <select name="selectedActivity" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                    @foreach($activities as $activity)
                        <option value="{{ $activity->id }}">{{$activity->name}}</option>
                    @endforeach
                </select>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluit</button>
                    <button type="submit" class="btn btn-primary">Toevoegen</button>
                </div>
            </form>
        </div>
    </div>
</div>
